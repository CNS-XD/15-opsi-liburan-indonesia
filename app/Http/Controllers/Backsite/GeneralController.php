<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\GeneralRequest;
use App\Http\Controllers\Controller;
use App\Models\ContactGeneral;
use App\Models\ContactSocmed;
use Illuminate\Http\Request;
use App\Models\Partner;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contactGeneral'] = ContactGeneral::first();

        return view('pages.backsite.general.index', $data);
    }

    public function datatablePartner()
    {
        $model = Partner::orderBy('created_at', 'desc');

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
                ? '<span class="badge badge-success"><i class="fa fa-check-circle mr5"></i> Active</span>'
                : '<span class="badge badge-danger"><i class="fa fa-times-circle mr5"></i> Non Active</span>';
        })
        ->addColumn('action', function ($data) {
            $btn = '<div class="btn-group">';
            $btn .=  '<button type="button" class="btn btn-warning btn-sm round" onClick="showModal(\'form_partner\', ' . $data->id . ')">
                        <i class="fa fa-pencil"></i>
                    </button>';
            $btn .=  '<button type="button" class="btn btn-danger btn-sm round" onClick="deleteData(\'form_partner\', ' . $data->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            $btn .= '</div>';
            return $btn;
        })
        ->rawColumns(['image', 'show', 'action'])
        ->make(true);

        return $dTable;
    }

    public function datatableSocmed()
    {
        $model = ContactSocmed::orderBy('created_at', 'desc');

        $dTable = DataTables()->of($model)
        ->addIndexColumn()
        ->editColumn('show', function ($data) {
            return $data->show
                ? '<span class="badge badge-success"><i class="fa fa-check-circle mr5"></i> Active</span>'
                : '<span class="badge badge-danger"><i class="fa fa-times-circle mr5"></i> Non Active</span>';
        })
        ->addColumn('action', function ($data) {
            $btn = '<div class="btn-group">';
            $btn .= '<button type="button" class="btn btn-warning btn-sm round" onClick="showModal(\'form_contact_socmed\', ' . $data->id . ')">
                        <i class="fa fa-pencil"></i>
                    </button>';
            $btn .= '<button type="button" class="btn btn-danger btn-sm round" onClick="deleteData(\'form_contact_socmed\', ' . $data->id . ')">
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
    public function store(GeneralRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = null;

            if ($request->form_input == 'form_partner') {
                $partner = new Partner();
                if (!empty($request->id))
                    $partner = Partner::findOrFail($request->id);
                $partner->name = $request->name;
                $partner->url = $request->url;
                $partner->show = $request->show;
                if ($request->hasFile('file_partner')) {
                    if (is_file(storage_path("app/public/" . $partner->image))) {
                        Storage::disk('public')->delete($partner->image);
                    }
                    $file_partner = $this->uploadFile($request->file_partner, '/partner');
                    $partner->image = $file_partner;
                }
                $partner->save();
            }

            if ($request->form_input == 'form_contact_general') {
                $contactGeneral = ContactGeneral::first();
                if (empty($contactGeneral)) {
                    $contactGeneral = new ContactGeneral();
                }
                $contactGeneral->email = $request->email;
                $contactGeneral->phone = $request->phone;
                $contactGeneral->address = $request->address;
                $contactGeneral->fax = $request->fax;
                $contactGeneral->latitude = $request->latitude;
                $contactGeneral->longitude = $request->longitude;
                $contactGeneral->save();
            }

            if ($request->form_input == 'form_contact_socmed') {
                $contactSocmed = new ContactSocmed();
                if (!empty($request->id))
                    $contactSocmed = ContactSocmed::findOrFail($request->id);
                $contactSocmed->type_socmed = $request->type_socmed;
                $contactSocmed->name_account = $request->name_account;
                $contactSocmed->url = $request->url;
                $contactSocmed->show = ContactSocmed::SHOW['publish'];
                $contactSocmed->save();
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
        if ($request->form_input == 'form_contact_socmed') {
            $data = ContactSocmed::findOrFail($id);
        } else {
            $data = Partner::findOrFail($id);
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
            if ($request->form_input == 'form_contact_socmed') {
                $contactSocmed = ContactSocmed::findOrFail($id)->delete();
            } else {
                $partner = Partner::findOrFail($id);
                if (is_file(storage_path("app/public/" . $partner->image))) {
                    Storage::disk('public')->delete($partner->image);
                }
                $partner->delete();
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
