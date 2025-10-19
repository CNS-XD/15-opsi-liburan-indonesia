<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\BlogRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use Alert;

class BlogController extends Controller
{
    use \App\Traits\AjaxTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.blog.index');
    }

    public function datatable()
    {
        $data = Blog::latest();

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('image', function ($data) {
            $dom    = new \DomDocument();
            @$dom->loadHtml($data->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $image = $dom->getElementsByTagName('img')[0];

            $return = "<img src='/backsite-assets/images/no-image-available.jpg' width='80px'>";
            if (!empty($image)) {
                $image = $image->getAttribute('src');
                $return = '<img src="' . $image . '" width="80px">';
            }

            return $return;
        })
        ->editColumn('title', function ($data) {
            return Str::words(strip_tags($data->title), 10);
        })
        ->addColumn('action', function ($data) {
            $btn = "";
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.blog.edit', $data->id) . '">
                        <i class="la la-edit"></i>
                    </a>
                    <button onClick="deleteConf('.$data->id.')" class="btn btn-danger btn-sm round btn_delete" title="Hapus data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
        })
        ->rawColumns(['image', 'title', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $editor = $this->iterateImage($request->description, '/blog');

            // Cek apakah slug sudah ada di database
            $originalSlug = Str::slug($request->title, '-');
            $slug = generateUniqueSlugBlog($originalSlug, null);

            $data = new Blog;
            $data->title = $request->title;
            $data->description = $editor[1]->saveHTML();
            $data->image = implode(',', $editor[0]);
            $data->type = $request->type;
            $data->show = $request->show;
            $data->slug = $slug;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.blog.index')->withSuccess('Successfully added data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to add data:  ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Blog::findOrFail($id);

            return response()->json([
                'data' => $data,
                'message' => 'Successfully Get Data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'data' => null,
                'message' => 'Failed to Get Data' . $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('validate-resource', [(new Blog), $id]);

        $data['data'] = Blog::findOrFail($id);
        return view('pages.backsite.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $this->authorize('validate-resource', [(new Blog), $id]);
    
        DB::beginTransaction();
        try {
            $data = Blog::findOrFail($id);
    
            // Optimasi slug
            $originalSlug = Str::slug($request->title, '-');
            $slug = generateUniqueSlugBlog($originalSlug, $id);
    
            // Proses description dan image jika berubah
            $image = $data->image; // Default ke image lama

            // Normalisasi description sebelum dibandingkan
            $requestContentNormalized = normalizeHtmlContent($request->description);
            $dataContentNormalized = normalizeHtmlContent($data->description);

            // Hanya proses jika description benar-benar berubah
            if ($requestContentNormalized !== $dataContentNormalized) {
                $editor = $this->iterateImage($request->description, '/blog');

                if (!empty($editor[0])) {
                    // Hapus image lama yang tidak digunakan
                    if (!empty($data->image)) {
                        deleteUnusedImages($data->image, $editor[0]);
                    }

                    // Simpan URL image baru
                    $image = implode(',', $editor[0]);
                } else {
                    // Jika description baru tidak memiliki image, hapus semua image lama
                    deleteAllImages($data->image);
                    $image = null;
                }

                $data->description = $editor[1]->saveHTML(); // Update description dengan versi terbaru
            }
    
            // Update data
            $data->title = $request->title;
            $data->image = $image;
            $data->type = $request->type;
            $data->show = $request->show;
            $data->slug = $slug;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.blog.index')->withSuccess('Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to change data' . $e->getMessage());
        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('validate-resource', [(new Blog), $id]);
    
        DB::beginTransaction();
        try {
            $data = Blog::findOrFail($id);
    
            // Ambil hanya nama file dari URL image
            $image = [];
            if (!empty($data->image)) {
                $urls = explode(',', $data->image);
                foreach ($urls as $url) {
                    // Parse nama file dari URL
                    $image[] = basename(parse_url($url, PHP_URL_PATH));
                }
            }
    
            // Hapus file image
            $this->clearImage($image, $id, (new Blog), '/blog', true);
    
            // Hapus data
            $data->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted data!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oops An Error Occurred: ' . $e->getMessage(),
            ]);
        }
    }

    public function setShow($id)
    {
        $this->authorize('validate-resource', [(new Blog), $id]);
        
        DB::beginTransaction();
        try {
            $data = Blog::findOrFail($id);
            $data->update([
                'show' => $data->show == Blog::SHOW['draft'] ? Blog::SHOW['publish'] : Blog::SHOW['draft']
            ]);
            DB::commit();

            $this->success = \Illuminate\Http\Response::HTTP_OK;
            $this->message = 'Status updated successfully!';
        } catch (\Exception $e) {
            $this->success = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message = 'Status failed to update!';
            Log::error("ERROR APP : " . $e->getMessage());
        }

        return $this->json();
    }
}
