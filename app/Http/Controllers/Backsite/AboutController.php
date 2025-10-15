<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\AboutRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\About;
use Alert;
use Log;
use DB;

class AboutController extends Controller
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
        
        $data['data'] = About::first();

        return view('pages.backsite.about.index', $data);
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
    public function store(AboutRequest $request)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = About::first();

            if (!$data) {
                // Jika belum ada data, buat baru
                $data = new About;
            }

            // Proses konten dan gambar jika berubah
            $image = $data->image; // Default ke gambar lama

            // Normalisasi konten sebelum dibandingkan
            $requestContentNormalized = normalizeHtmlContent($request->description);
            $dataContentNormalized = normalizeHtmlContent($data->description);

            // Hanya proses jika konten benar-benar berubah
            if ($requestContentNormalized !== $dataContentNormalized) {
                $editor = $this->iterateImage($request->description, 'about');

                if (!empty($editor[0])) {
                    // Hapus gambar lama yang tidak digunakan
                    if (!empty($data->image)) {
                        deleteUnusedImages($data->image, $editor[0]);
                    }

                    // Simpan URL gambar baru
                    $image = implode(',', $editor[0]);
                } else {
                    // Jika konten baru tidak memiliki gambar, hapus semua gambar lama
                    deleteAllImages($data->image);
                    $image = null;
                }

                $data->description = $editor[1]->saveHTML(); // Update konten dengan versi terbaru
            }

            // Update data
            $data->image = $image;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.about.index')->withSuccess('Successfully changed data!');
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