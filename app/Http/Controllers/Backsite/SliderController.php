<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\SliderRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
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
            Alert::error('Failed !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.slider.index');
    }

    public function datatable()
    {
        $data = Slider::latest();

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('slider', function ($data) {
            $return = "<img src='/backsite-assets/images/no-image-available.jpg' width='80px'>";
            if (!empty($data->value)) {
                $return = '<img src="/storage/' . $data->value . '" width="80px">';
            }

            return $return;
        })
        ->addColumn('action', function ($data) {
            $btn = "";
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.slider.edit', $data->id) . '">
                        <i class="la la-edit"></i>
                    </a>
                    <button onClick="deleteConf('.$data->id.')" class="btn btn-danger btn-sm btn_delete round" title="Delete data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
        })
        ->rawColumns(['slider', 'action'])
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
            Alert::error('Failed !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Slider;
            if ($request->hasFile('slider')) {
                $slider = $this->uploadFile($request->slider, '/slider-slider');
                // store uploaded file path in 'value' column per migration
                $data->value = $slider;
            }
            $data->type = $request->type;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->show = $request->show;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.slider.index')->withSuccess('Successfully added data!');
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
            $data = Slider::findOrFail($id);

            return response()->json([
                'data' => $data,
                'message' => 'Success Get Data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'data' => null,
                'message' => 'Failed to Get Data!' . $e->getMessage(),
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
        $this->authorize('validate-resource', [(new Slider), $id]);

        $data['data'] = Slider::findOrFail($id);
        return view('pages.backsite.slider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Slider::findOrFail($id);
            if ($request->hasFile('slider')) {
                $slider = $this->uploadFile($request->slider, '/slider-slider');

                if (!empty($data->value) && is_file(storage_path("app/public/" . $data->value))) {
                    Storage::disk('public')->delete($data->value);
                }

                $data->value = $slider;
            }
            $data->type = $request->type;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->show = $request->show;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.slider.index')->withSuccess('Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Oops something went wrong: ' . $e->getMessage());
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
        $this->authorize('validate-resource', [(new Slider), $id]);
    
        DB::beginTransaction();
        try {
            $data = Slider::findOrFail($id);
            if (!empty($data->value) && is_file(storage_path("app/public/" . $data->value)))
                Storage::disk('public')->delete($data->value);

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
                'message' => 'Oops something went wrong: ' . $e->getMessage(),
            ]);
        }
    }

    public function setShow($id)
    {
        $this->authorize('validate-resource', [(new Slider), $id]);
        
        DB::beginTransaction();
        try {
            $data = Slider::findOrFail($id);
            $data->update([
                'show' => $data->show == Slider::SHOW['draft'] ? Slider::SHOW['publish'] : Slider::SHOW['draft']
            ]);
            DB::commit();

            $this->success = \Illuminate\Http\Response::HTTP_OK;
            $this->message = 'Status successfully updated!';
        } catch (\Exception $e) {
            $this->success = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message = 'Show failed to update!';
            Log::error("ERROR APP : " . $e->getMessage());
        }

        return $this->json();
    }
}
