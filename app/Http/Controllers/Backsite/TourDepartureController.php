<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourDepartureRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TourDeparture;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Departure;
use App\Models\Tour;

class TourDepartureController extends Controller
{
    use \App\Traits\AjaxTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idTour)
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $tour = Tour::with('tour_departures')->findOrFail($idTour);

        return view('pages.backsite.tour-departure.index', compact('tour'));
    }


    public function datatable($idTour)
    {
        $data = TourDeparture::with(['tour', 'departure'])
            ->where('id_tour', $idTour)
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('tour', function ($row) {
                return optional($row->tour)->title ?? '-';
            })

            ->addColumn('departure', function ($row) {
                return optional($row->departure)->title ?? '-';
            })

            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('backsite.tour-departure.edit', [$row->id_tour, $row->id]).'"
                    class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <button onclick="deleteConf('.$row->id.')"
                            class="btn btn-danger btn-sm">
                        Delete
                    </button>
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
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $tour = Tour::findOrFail($idTour);
        $departures = Departure::select('id', 'title')->get();

        return view(
            'pages.backsite.tour-departure.create',
            compact('tour', 'departures') 
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourDepartureRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = new TourDeparture;

            $data->id_tour = $request->id_tour;
            $data->id_departure = $request->id_departure;

            $data->save();
            DB::commit();

            return redirect()
                ->route('backsite.tour-departure.index', $request->id_tour)
                ->withSuccess('Successfully added Tour Departure!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());

            return redirect()->back()->withInput()->with(
                'error_msg',
                'Failed to add data: ' . $e->getMessage()
            );
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
            $data = TourDeparture::findOrFail($id);

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
    public function edit($idTour, $idTourDeparture)
    {
        $data = TourDeparture::with('tour')->findOrFail($idTourDeparture);

        $departures = Departure::select('id', 'title')->get();

        return view(
            'pages.backsite.tour-departure.edit',
            compact('data', 'departures')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourDepartureRequest $request, $id)
    {
        $data = TourDeparture::findOrFail($id);
        $this->authorize('validate-resource', [$data, $id]);

        DB::beginTransaction();
        try {
            $data->id_tour = $request->id_tour;
            $data->id_departure = $request->id_departure;
            $data->save();

            DB::commit();

            return redirect()
                ->route('backsite.tour-departure.index', $data->id_tour)
                ->with('success', 'Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());

            return redirect()
                ->back()
                ->with('error_msg', 'Failed to change data: ' . $e->getMessage());
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
        $this->authorize('validate-resource', [(new TourDeparture), $id]);
    
        DB::beginTransaction();
        try {
            $data = TourDeparture::findOrFail($id);

            $data->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted data!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oops An Error Occurred: ' . $e->getMessage(),
            ]);
        }
    }
}
