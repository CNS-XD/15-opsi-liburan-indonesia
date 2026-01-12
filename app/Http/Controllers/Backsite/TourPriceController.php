<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourPriceRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TourPrice;
use App\Models\Tour;

class TourPriceController extends Controller
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

        return view('pages.backsite.tour-price.index', compact('tour'));
    }




    public function datatable($idTour)
    {
        $data = TourPrice::where('id_tour', $idTour)->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('pax', function ($row) {
                return $row->pax . ' Pax';
            })

            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format($row->price, 0, ',', '.');
            })

            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-group">
                        <a href="'.route('backsite.tour-price.edit', [$row->id_tour, $row->id]).'"
                        class="btn btn-warning btn-sm round">
                            <i class="la la-edit"></i>
                        </a>

                        <button onclick="deleteConf('.$row->id.')"
                                class="btn btn-danger btn-sm round">
                            <i class="la la-trash"></i>
                        </button>
                    </div>
                ';
            })

            ->rawColumns(['action'])
            ->make(true);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idTour)
    {
        // Alert (tetap dipakai, ini sudah benar)
        if (!empty(session('error_msg'))) {
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        }

        if (!empty(session('success'))) {
            Alert::success('Success !', session('success'));
        }

        // Ambil tour (WAJIB)
        $tour = Tour::findOrFail($idTour);

        // ⛔ HAPUS $types (tidak relevan)

        return view(
            'pages.backsite.tour-price.create',
            compact('tour')
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourPriceRequest $request)
    {
        DB::beginTransaction();

        try {
            TourPrice::create([
                'id_tour' => $request->id_tour,
                'pax'     => $request->pax,
                'price'   => $request->price,
            ]);

            DB::commit();

            return redirect()
                ->route('backsite.tour-price.index', $request->id_tour)
                ->with('success', 'Successfully added price!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->with('error_msg', $e->getMessage());
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
            $data = TourPrice::findOrFail($id);

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
    public function edit($idTour, $idTourPrice)
    {
        // 1. Ambil tour (untuk breadcrumb & back button)
        $tour = Tour::findOrFail($idTour);

        // 2. Ambil data tour price + validasi relasi tour
        $data = TourPrice::where('id_tour', $idTour)
            ->findOrFail($idTourPrice);

        return view(
            'pages.backsite.tour-price.edit',
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
    public function update(TourPriceRequest $request, $id)
    {
        $data = TourPrice::findOrFail($id);

        // Authorization (optional, jika pakai gate)
        // $this->authorize('validate-resource', [$data, $id]);

        DB::beginTransaction();

        try {
            $data->pax   = $request->pax;
            $data->price = $request->price;
            $data->save();

            DB::commit();

            return redirect()
                ->route('backsite.tour-price.index', $data->id_tour)
                ->with('success', 'Successfully updated price!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR PRICE UPDATE : ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error_msg', 'Failed to update data: ' . $e->getMessage());
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
        DB::beginTransaction();
        try {
            $data = TourPrice::findOrFail($id);
            $this->authorize('validate-resource', [$data, $id]);

            $data->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Price deleted!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


}
