<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourDestinationRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TourDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Destination;
use App\Models\Tour;

class TourDestinationController extends Controller
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

        $tour = Tour::with('tour_destinations')->findOrFail($idTour);

        return view('pages.backsite.tour-destination.index', compact('tour'));
    }


public function datatable($idTour)
{
    $data = TourDestination::with(['tour', 'destination'])
        ->where('id_tour', $idTour)
        ->latest();

    return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('tour', function ($row) {
            return optional($row->tour)->title ?? '-';
        })

        ->addColumn('destination', function ($row) {
            return optional($row->destination)->title ?? '-';
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            $btn .= '
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm round"
                       href="'.route('backsite.tour-destination.edit', [$row->id_tour, $row->id]).'">
                        <i class="la la-edit"></i>
                    </a>

                    <button
                        onClick="deleteConf('.$row->id.')"
                        class="btn btn-danger btn-sm btn_delete round"
                        title="Delete data">
                        <i class="la la-trash"></i>
                    </button>
                </div>
            ';
            return $btn;
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
        $destinations = Destination::select('id', 'title')->get();

        return view(
            'pages.backsite.tour-destination.create',
            compact('tour', 'destinations') 
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourDestinationRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = new TourDestination;

            $data->id_tour = $request->id_tour;
            $data->id_destination = $request->id_destination;

            $data->save();
            DB::commit();

            return redirect()
                ->route('backsite.tour-destination.index', $request->id_tour)
                ->withSuccess('Successfully added Tour Destination!');
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
            $data = TourDestination::findOrFail($id);

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
    public function edit($idTour, $idTourDestination)
    {
        $data = TourDestination::with('tour')->findOrFail($idTourDestination);

        $destinations = Destination::select('id', 'title')->get();

        return view(
            'pages.backsite.tour-destination.edit',
            compact('data', 'destinations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourDestinationRequest $request, $id)
    {
        $data = TourDestination::findOrFail($id);
        $this->authorize('validate-resource', [$data, $id]);

        DB::beginTransaction();
        try {
            $data->id_tour = $request->id_tour;
            $data->id_destination = $request->id_destination;
            $data->save();

            DB::commit();

            return redirect()
                ->route('backsite.tour-destination.index', $data->id_tour)
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
    DB::beginTransaction();
    try {
        $data = TourDestination::findOrFail($id);
        $this->authorize('validate-resource', $data);

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
        ], 500);
    }
}
}
