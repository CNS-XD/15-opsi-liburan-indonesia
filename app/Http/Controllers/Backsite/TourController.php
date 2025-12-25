<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tour;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
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

        return view('pages.backsite.tour.index');
    }

    public function datatable()
    {
        $data = Tour::latest();

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
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.tour.edit', $data->id) . '">
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

        return view('pages.backsite.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Tour;
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/tour');
                $data->image = $image;
            }
            $data->name = $request->name;
            $data->description = $request->description;
            $data->rating = $request->rating;
            $data->show = $request->show;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.tour.index')->withSuccess('Successfully added data!');
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
            $data = Tour::findOrFail($id);

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
        $this->authorize('validate-resource', [(new Tour), $id]);

        $data['data'] = Tour::findOrFail($id);
        return view('pages.backsite.tour.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        $this->authorize('validate-resource', [(new Tour), $id]);
    
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
    
            // Update data
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/tour');

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
    
            return redirect()->route('backsite.tour.index')->withSuccess('Successfully changed data!');
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
        $this->authorize('validate-resource', [(new Tour), $id]);
    
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
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
        $this->authorize('validate-resource', [(new Tour), $id]);
        
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
            $data->update([
                'show' => $data->show == Tour::SHOW['draft'] ? Tour::SHOW['publish'] : Tour::SHOW['draft']
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
