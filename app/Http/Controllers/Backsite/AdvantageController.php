<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\AdvantageRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Advantage;
use Storage;
use Alert;
use Log;
use DB;

class AdvantageController extends Controller
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
            Alert::error('Fail !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.advantage.index');
    }

    public function datatable()
    {
        $data = Advantage::latest();

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('icon', function ($data) {
            $return = "<img src='/backsite-assets/images/no-image-available.jpg' width='80px'>";
            if (!empty($data->icon)) {
                $return = '<img src="/storage/' . $data->icon . '" width="80px">';
            }

            return $return;
        })
        ->addColumn('action', function ($data) {
            $btn = "";
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.advantage.edit', $data->id) . '">
                        <i class="la la-edit"></i>
                    </a>
                    <button onClick="deleteConf('.$data->id.')" class="btn btn-danger btn-sm btn_delete round" title="Delete data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
        })
        ->rawColumns(['icon', 'action'])
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
            Alert::error('Fail !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.advantage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvantageRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Advantage;
            if ($request->hasFile('icon')) {
                $icon = $this->uploadFile($request->icon, '/advantage-icon');
                $data->icon = $icon;
            }
            $data->title = $request->title;
            $data->description = $request->description;
            $data->show = $request->show;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.advantage.index')->withSuccess('Successfully added data!');
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
            $data = Advantage::findOrFail($id);

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
        $this->authorize('validate-resource', [(new Advantage), $id]);

        $data['data'] = Advantage::findOrFail($id);
        return view('pages.backsite.advantage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvantageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Advantage::findOrFail($id);
            if ($request->hasFile('icon')) {
                $icon = $this->uploadFile($request->icon, '/advantage-icon');

                if (is_file(storage_path("app/public/" . $data->icon))) {
                    Storage::disk('public')->delete($data->icon);
                }

                $data->icon = $icon;
            }
            $data->title = $request->title;
            $data->description = $request->description;
            $data->show = $request->show;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.advantage.index')->withSuccess('Successfully changed data!');
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
        $this->authorize('validate-resource', [(new Advantage), $id]);
    
        DB::beginTransaction();
        try {
            $data = Advantage::findOrFail($id);
            if (is_file(storage_path("app/public/" . $data->icon)))
                Storage::disk('public')->delete($data->icon);

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
        $this->authorize('validate-resource', [(new Advantage), $id]);
        
        DB::beginTransaction();
        try {
            $data = Advantage::findOrFail($id);
            $data->update([
                'show' => $data->show == Advantage::SHOW['draft'] ? Advantage::SHOW['publish'] : Advantage::SHOW['draft']
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
