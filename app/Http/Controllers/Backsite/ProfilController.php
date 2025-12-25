<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\ProfilRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MKecamatan;
use App\Models\MProvinsi;
use App\Models\MKabKota;
use App\Models\Sekolah;
use App\Models\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $data['user'] = Auth::user();

        return view('pages.backsite.profil.index', $data);
    }

    public function update(ProfilRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = User::where('id', Auth::user()->id)->first();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->nationality = $request->nationality;
            if ($request->hasFile('photo')) {
                if (!empty($data->photo)) {
                    $this->removeFile($data->photo, 'photo-profile');
                }
                $pathRoute = "/photo-profile";
                $newPath = $this->uploadFile($request->photo, $pathRoute);
                $data->photo = $newPath;
            }
            if (!empty($request->password)) {
                $data->password = Hash::make($request->password);
                $data->plain_text = $request->password;
            }
            $data->save();

            DB::commit();
            return back()->with('success', 'Data Successfully Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return back()->with('error_msg', $e->getMessage());
        }
    }
}
