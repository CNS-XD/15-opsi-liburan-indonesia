<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\ThemeRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ThemeController extends Controller
{
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

        return view('pages.backsite.theme.index');
    }

    public function datatable()
    {
        $data = Theme::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('color_1', function ($data) {
                $color1 = $data->color_1;
                $return = '<div style="with:10px; height:10px; background:' . $color1 . '"></div>';
                return $return;
            })
            ->editColumn('color_2', function ($data) {
                $color2 = $data->color_2;
                $return = '<div style="with:10px; height:10px; background:' . $color2 . '"></div>';
                return $return;
            })
            ->rawColumns(['color_1', 'color_2'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('validate-resource', [(new Theme), $id]);

        $data['data'] = Theme::findOrFail($id);
        return view('pages.backsite.theme.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('validate-resource', [(new Theme), $id]);
        
        DB::beginTransaction();
        try {
            $data = Theme::findOrFail($id);
            $data->color_1 = $request->color1;
            $data->color_2 = $request->color2;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.theme.index')->withSuccess('Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Oops An Error Occurred: ' . $e->getMessage());
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
        //
    }
}
