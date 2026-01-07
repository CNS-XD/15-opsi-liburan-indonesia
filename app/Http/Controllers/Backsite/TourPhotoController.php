<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourPhotoRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TourDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TourPhoto;
use App\Models\Tour;

class TourPhotoController extends Controller
{
    use \App\Traits\AjaxTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idTour)
    {
        if (session('error_msg')) {
            Alert::error('Failed!', session('error_msg'))->persistent('Tutup');
        }

        if (session('success')) {
            Alert::success('Success!', session('success'));
        }

        $tour = Tour::findOrFail($idTour);
        $photos = TourPhoto::where('id_tour', $idTour)
            ->latest()
            ->get();

        return view(
            'pages.backsite.tour-photo.index',
            compact('tour', 'photos')
        );
    }




    public function datatable($idTour)
    {
        $data = TourPhoto::where('id_tour', $idTour)
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            // PHOTO
            ->addColumn('image', function ($row) {
                return '
                    <img src="'.asset('storage/'.$row->image).'"
                        class="img-thumbnail"
                        style="height:80px">
                ';
            })

            // ACTION (POLA ADVANTAGE ✔)
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-group">

                        <a class="btn btn-warning btn-sm round"
                        href="'.route('backsite.tour-photo.edit', [$row->id_tour, $row->id]).'">
                            <i class="la la-edit"></i>
                        </a>

                        <button
                            onclick="deleteConf('.$row->id.')"
                            class="btn btn-danger btn-sm round"
                            title="Delete data">
                            <i class="la la-trash"></i>
                        </button>

                    </div>
                ';
            })

            ->rawColumns(['image', 'show', 'action'])
            ->make(true);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idTour)
    {
        if (!empty(session('error_msg'))) {
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        }

        if (!empty(session('success'))) {
            Alert::success('Success !', session('success'));
        }

        $tour = Tour::findOrFail($idTour);

        return view(
            'pages.backsite.tour-photo.create',
            compact('tour')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id_tour' => 'required|exists:tours,id',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'show' => 'required|boolean'
            ]);

            $path = $request->file('image')->store('tour/photos', 'public');

            TourPhoto::create([
                'id_tour' => $request->id_tour,
                'image' => $path,
                'show' => $request->show,
            ]);

            DB::commit();

            return redirect()
                ->route('backsite.tour-photo.index', $request->id_tour)
                ->withSuccess('Tour photo added successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error_msg', $e->getMessage());
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
            $data = TourPhoto::findOrFail($id);

            return response()->json([
                'data' => $data,
                'message' => 'Successfully Get Data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'data' => null,
                'message' => 'Failed to Get Data' . $e->getMessage(),
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
    public function edit($idTour, $idTourPhoto)
    {
        // Tour (untuk breadcrumb & readonly select)
        $tour = Tour::findOrFail($idTour);

        // Ambil data tour photo (PASTI MILIK TOUR TERSEBUT)
        $data = TourPhoto::where('id_tour', $idTour)
            ->findOrFail($idTourPhoto);

        return view(
            'pages.backsite.tour-photo.edit',
            compact('tour', 'data')
        );
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
        $data = TourPhoto::findOrFail($id);

        // VALIDATION
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'show'  => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {
            // JIKA ADA FOTO BARU → HAPUS YANG LAMA
            if ($request->hasFile('image')) {
                if ($data->image && Storage::disk('public')->exists($data->image)) {
                    Storage::disk('public')->delete($data->image);
                }

                $data->image = $request->file('image')
                    ->store('tour/photos', 'public');
            }

            $data->show       = $request->show;
            $data->save();

            DB::commit();

            return redirect()
                ->route('backsite.tour-photo.index', $data->id_tour)
                ->withSuccess('Successfully updated tour photo!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR PHOTO UPDATE : ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error_msg',
                    'Failed to update data: ' . $e->getMessage()
                );
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
        try {
            $data = TourPhoto::findOrFail($id);

            Storage::disk('public')->delete($data->image);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
