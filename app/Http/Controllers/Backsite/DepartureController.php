<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\DepartureRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Departure;
use Alert;
use Log;
use DB;

class DepartureController extends Controller
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
            Alert::error('Gagal !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Berhasil !', session('success'));

        return view('pages.backsite.departure.index');
    }

    public function datatable()
    {
        $data = Departure::latest();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function ($data) {
            $btn = "";
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round" href="' . route('backsite.departure.edit', $data->id) . '">
                        <i class="la la-edit"></i>
                    </a>
                    <button onClick="deleteConf('.$data->id.')" class="btn btn-danger btn-sm round btn_delete" title="Hapus data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
        })
        ->rawColumns(['aksi'])
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
            Alert::error('Gagal !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Berhasil !', session('success'));

        return view('pages.backsite.departure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartureRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Departure;
            $data->title = $request->title;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.departure.index')->withSuccess('Berhasil menambah data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Gagal menambah data: ' . $e->getMessage());
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
            $data = Departure::findOrFail($id);

            return response()->json([
                'data' => $data,
                'message' => 'Berhasil Mendapatkan Data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'data' => null,
                'message' => 'Gagal Mendapatkan Data' . $e->getMessage(),
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
        $this->authorize('validate-resource', [(new Departure), $id]);

        $data['data'] = Departure::findOrFail($id);
        return view('pages.backsite.departure.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartureRequest $request, $id)
    {
        $this->authorize('validate-resource', [(new Departure), $id]);
    
        DB::beginTransaction();
        try {
            $data = Departure::findOrFail($id); // Pastikan data ditemukan, jika tidak maka gagal langsung
    
            // Update data
            $data->title = $request->title;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.departure.index')->withSuccess('Berhasil merubah data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Gagal merubah data' . $e->getMessage());
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
        $this->authorize('validate-resource', [(new Departure), $id]);
    
        DB::beginTransaction();
        try {
            $data = Departure::findOrFail($id);
    
            // Hapus data
            $data->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil hapus data!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ups Terjadi Kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
