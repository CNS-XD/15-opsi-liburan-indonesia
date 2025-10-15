<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TestimonyRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Testimony;
use Storage;
use Alert;
use Log;
use DB;

class TestimonyController extends Controller
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

        return view('pages.backsite.testimony.index');
    }

    public function datatable()
    {
        $data = Testimony::latest();

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('image', function ($data) {
            $return = "<img src='/backsite-assets/images/no-image-available.jpg' width='80px'>";
            if (!empty($data->image)) {
                $return = '<img src="/storage/' . $data->image . '" width="80px">';
            }

            return $return;
        })
        ->editColumn('rating', function ($data) {
            if ($data->rating == 1) {
                $return = '⭐';
            } elseif ($data->rating == 2) {
                $return = '⭐⭐';
            } elseif ($data->rating == 3) {
                $return = '⭐⭐⭐';
            } elseif ($data->rating == 4) {
                $return = '⭐⭐⭐⭐';
            } elseif ($data->rating == 5) {
                $return = '⭐⭐⭐⭐⭐';
            }

            return $return;
        })
        ->editColumn('description', function ($data) {
            return strip_tags($data->description);
        })
        ->addColumn('action', function ($data) {
            $btn = "";
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.testimony.edit', $data->id) . '">
                        <i class="la la-edit"></i>
                    </a>
                    <button onClick="deleteConf('.$data->id.')" class="btn btn-danger btn-sm round btn_delete" title="Hapus data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
        })
        ->rawColumns(['image', 'rating', 'description', 'action'])
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

        return view('pages.backsite.testimony.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonyRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Testimony;
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/testimony');
                $data->image = $image;
            }
            $data->name = $request->name;
            $data->description = $request->description;
            $data->rating = $request->rating;
            $data->show = $request->show;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.testimony.index')->withSuccess('Successfully added data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to add data: ' . $e->getMessage());
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
            $data = Testimony::findOrFail($id);

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
        $this->authorize('validate-resource', [(new Testimony), $id]);

        $data['data'] = Testimony::findOrFail($id);
        return view('pages.backsite.testimony.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonyRequest $request, $id)
    {
        $this->authorize('validate-resource', [(new Testimony), $id]);
    
        DB::beginTransaction();
        try {
            $data = Testimony::findOrFail($id);
    
            // Update data
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/testimony');

                if (is_file(storage_path("app/public/" . $data->image))) {
                    Storage::disk('public')->delete($data->image);
                }

                $data->image = $image;
            }
            $data->name = $request->name;
            $data->description = $request->description;
            $data->rating = $request->rating;
            $data->show = $request->show;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.testimony.index')->withSuccess('Successfully changed data!');
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
        $this->authorize('validate-resource', [(new Testimony), $id]);
    
        DB::beginTransaction();
        try {
            $data = Testimony::findOrFail($id);
            if (is_file(storage_path("app/public/" . $data->image)))
                Storage::disk('public')->delete($data->image);

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
        $this->authorize('validate-resource', [(new Testimony), $id]);
        
        DB::beginTransaction();
        try {
            $data = Testimony::findOrFail($id);
            $data->update([
                'show' => $data->show == Testimony::SHOW['draft'] ? Testimony::SHOW['publish'] : Testimony::SHOW['draft']
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
