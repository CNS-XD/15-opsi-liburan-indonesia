<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\Beranda\BerandaRequest;
use App\Http\Controllers\Controller;
use App\Models\InfoKontakSosmed;
use App\Models\InfoKontakUmum;
use Illuminate\Http\Request;
use App\Models\InfoSponsor;
use App\Models\InfoHeader;
use Storage;
use DB;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['infoHeader'] = InfoHeader::where('id_domain', session('id_domain'))->first();
        $data['infoKontakUmum'] = InfoKontakUmum::where('id_domain', session('id_domain'))->first();

        return view('pages.backsite.beranda.index', $data);
    }

    public function datatableSponsor()
    {
        $model = InfoSponsor::where('id_domain', session('id_domain'))->orderBy('created_at', 'desc');

        $dTable = DataTables()->of($model)
        ->addIndexColumn()
        ->editColumn('image', function ($data) {
            $return = "<img src='/backsite-assets/images/no-image-available.jpg' width='80px'>";
            if (!empty($data->image)) {
                $return = '<img src="/storage/' . $data->image . '" width="80px">';
            }
            return $return;
        })
        ->editColumn('show', function ($data) {
            return $data->show
                ? '<span class="badge badge-success"><i class="fa fa-check-circle mr5"></i> Tampil</span>'
                : '<span class="badge badge-danger"><i class="fa fa-times-circle mr5"></i> Tidak Tampil</span>';
        })
        ->addColumn('action', function ($data) {
            $btn = '<div class="btn-group">';
            $btn .=  '<button type="button" class="btn btn-warning btn-sm round" onClick="showModal(\'form_sponsor\', ' . $data->id . ')">
                        <i class="fa fa-pencil"></i>
                    </button>';
            $btn .=  '<button type="button" class="btn btn-danger btn-sm round" onClick="deleteData(\'form_sponsor\', ' . $data->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            $btn .= '</div>';
            return $btn;
        })
        ->rawColumns(['image', 'show', 'action'])
        ->make(true);

        return $dTable;
    }

    public function datatableSosmed()
    {
        $model = InfoKontakSosmed::where('id_domain', session('id_domain'))->orderBy('created_at', 'desc');

        $dTable = DataTables()->of($model)
        ->addIndexColumn()
        ->editColumn('show', function ($data) {
            return $data->show
                ? '<span class="badge badge-success"><i class="fa fa-check-circle mr5"></i> Tampil</span>'
                : '<span class="badge badge-danger"><i class="fa fa-times-circle mr5"></i> Tidak Tampil</span>';
        })
        ->addColumn('action', function ($data) {
            $btn = '<div class="btn-group">';
            $btn .= '<button type="button" class="btn btn-warning btn-sm round" onClick="showModal(\'form_kontak_sosmed\', ' . $data->id . ')">
                        <i class="fa fa-pencil"></i>
                    </button>';
            $btn .= '<button type="button" class="btn btn-danger btn-sm round" onClick="deleteData(\'form_kontak_sosmed\', ' . $data->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            $btn .= '</div>';
            return $btn;
        })
        ->rawColumns(['show', 'action'])
        ->make(true);

        return $dTable;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BerandaRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = null;

            if ($request->form_input == 'form_header') {
                $infoHeader = InfoHeader::where('id_domain', session('id_domain'))->first();
                if (empty($infoHeader)) {
                    $infoHeader = new InfoHeader();
                    $infoHeader->id_domain = session('id_domain');
                }

                if ($request->hasFile('file_background')) {
                    if (is_file(storage_path("app/public/" . $infoHeader->background))) {
                        Storage::disk('public')->delete($infoHeader->background);
                    }
                    $file_background = $this->uploadFile($request->file_background, '2025/' . strtolower(session('folder_domain')) . '/header-background');
                    $infoHeader->background = $file_background;
                }

                if ($request->hasFile('file_ilustrasi')) {
                    if (is_file(storage_path("app/public/" . $infoHeader->ilustrasi))) {
                        Storage::disk('public')->delete($infoHeader->ilustrasi);
                    }
                    $file_ilustrasi = $this->uploadFile($request->file_ilustrasi, '2025/' . strtolower(session('folder_domain')) . '/header-ilustrasi');
                    $infoHeader->ilustrasi = $file_ilustrasi;
                }

                $infoHeader->judul = $request->judul;
                $infoHeader->judul_countdown = $request->judul_countdown;
                $infoHeader->running_text = $request->running_text;
                $infoHeader->link = $request->link;
                $infoHeader->countdown = $request->countdown;
                $infoHeader->deskripsi = $request->deskripsi;
                $infoHeader->save();
                $data = $infoHeader;
            }

            if ($request->form_input == 'form_sponsor') {
                $infoSponsor = new InfoSponsor();
                $infoSponsor->id_domain = session('id_domain');
                if (!empty($request->id))
                    $infoSponsor = InfoSponsor::findOrFail($request->id);
                $infoSponsor->nama = $request->nama;
                $infoSponsor->url = $request->url;
                $infoSponsor->show = $request->show;
                if ($request->hasFile('file_sponsor')) {
                    if (is_file(storage_path("app/public/" . $infoSponsor->image))) {
                        Storage::disk('public')->delete($infoSponsor->image);
                    }
                    $file_sponsor = $this->uploadFile($request->file_sponsor, '2025/' . strtolower(session('folder_domain')) . '/sponsor');
                    $infoSponsor->image = $file_sponsor;
                }
                $infoSponsor->save();
            }

            if ($request->form_input == 'form_kontak_umum') {
                $infoKontakUmum = InfoKontakUmum::where('id_domain', session('id_domain'))->first();
                if (empty($infoKontakUmum)) {
                    $infoKontakUmum = new InfoKontakUmum();
                    $infoKontakUmum->id_domain = session('id_domain');
                }
                $infoKontakUmum->email = $request->email;
                $infoKontakUmum->telepon = $request->telepon;
                $infoKontakUmum->alamat = $request->alamat;
                $infoKontakUmum->fax = $request->fax;
                $infoKontakUmum->latitude = $request->latitude;
                $infoKontakUmum->longitude = $request->longitude;
                $infoKontakUmum->save();
            }

            if ($request->form_input == 'form_kontak_sosmed') {
                $infoKontakSosmed = new InfoKontakSosmed();
                $infoKontakSosmed->id_domain = session('id_domain');
                if (!empty($request->id))
                    $infoKontakSosmed = InfoKontakSosmed::findOrFail($request->id);
                $infoKontakSosmed->jenis_sosmed = $request->jenis_sosmed;
                $infoKontakSosmed->nama_akun = $request->nama_akun;
                $infoKontakSosmed->url = $request->url;
                $infoKontakSosmed->show = InfoKontakSosmed::SHOW['publish'];
                $infoKontakSosmed->save();
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Successfully updated data.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if ($request->form_input == 'form_kontak_sosmed') {
            $data = InfoKontakSosmed::findOrFail($id);
        } else {
            $data = InfoSponsor::findOrFail($id);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Success get data.',
        ]);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->form_input == 'form_kontak_sosmed') {
                $infoKontakSosmed = InfoKontakSosmed::findOrFail($id)->delete();
            } else {
                $infoSponsor = InfoSponsor::findOrFail($id);
                if (is_file(storage_path("app/public/" . $infoSponsor->image))) {
                    Storage::disk('public')->delete($infoSponsor->image);
                }
                $infoSponsor->delete();
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted data.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
