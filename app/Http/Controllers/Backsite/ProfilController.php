<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\Profil\ProfilRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MKecamatan;
use App\Models\MProvinsi;
use App\Models\MKabKota;
use App\Models\Sekolah;
use App\Models\User;
use Carbon\Carbon;
use Alert;
use Auth;
use Hash;
use Pdf;

class ProfilController extends Controller
{
    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Gagal !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Berhasil !', session('success'));

        $data['user'] = Auth::user();

        return view('pages.backsite.profil.index', $data);
    }

    public function update(ProfilRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->hasFile('photo')) {
                if (!empty($user->photo)) {
                    $this->removeFile($user->photo, 'photo-profile');
                }
                $pathRoute = "/photo-profile";
                $newPath = $this->uploadFile($request->photo, $pathRoute);
                $user->photo = $newPath;
            }
            if (!empty($request->password)) {
                $user->password = \Hash::make($request->password);
                $user->plain_text = $request->password;
            }
            $user->save();

            DB::commit();
            return back()->with('success', 'Data Berhasil Di Update');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return back()->with('error_msg', $e->getMessage());
        }
    }
}
