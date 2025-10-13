<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Storage;

class FormEditController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.backsite.form-edit', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'negara' => 'nullable|string|max:255',
            'profesi' => 'nullable|string|max:255',
            'tentang' => 'nullable|string',
            'quote' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,png,jpeg|max:800',
            'foto_sampul' => 'nullable|image|mimes:jpg,png,jpeg|max:800',
        ]);
    
        $user = Auth::user();
        $data = $request->except(['foto_profil', 'foto_sampul']);
    
        // Upload Foto Profil
        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('uploads/foto_profil', 'public');
        }
    
        // Upload Foto Sampul
        if ($request->hasFile('foto_sampul')) {
            if ($user->foto_sampul) {
                Storage::disk('public')->delete($user->foto_sampul);
            }
            $data['foto_sampul'] = $request->file('foto_sampul')->store('uploads/foto_sampul', 'public');
        }
    
        $user->update($data);
    
        return redirect()->route('form.edit')->with('success', 'Profil berhasil diperbarui!');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'negara' => 'nullable|string|max:255',
            'profesi' => 'nullable|string|max:255',
            'tentang' => 'nullable|string',
            'quote' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpg,png,jpeg|max:800',
            'foto_sampul' => 'nullable|image|mimes:jpg,png,jpeg|max:800',
        ]);
    
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'negara' => $request->negara,
            'profesi' => $request->profesi,
            'tentang' => $request->tentang,
            'quote' => $request->quote,
            'foto_profil' => $request->foto_profil,
            'foto_sampul' => $request->foto_sampul,
        ]);
    
        return redirect()->back()->with('success', 'Quote berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
