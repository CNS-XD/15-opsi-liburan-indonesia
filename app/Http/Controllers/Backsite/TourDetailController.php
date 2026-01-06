<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourDetailRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TourDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TourDetail;
use App\Models\Tour;

class TourDetailController extends Controller
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

        $tour = Tour::with('tour_details')->findOrFail($idTour);

        return view('pages.backsite.tour-detail.index', compact('tour'));
    }



    public function datatable($idTour)
    {
        $data = TourDetail::with('tour')
            ->where('id_tour', $idTour)
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            // TOUR
            ->addColumn('tour', function ($row) {
                return optional($row->tour)->title ?? '-';
            })

            // TYPE (BIAR RAPI)
            ->addColumn('type', function ($row) {
                return ucfirst(str_replace('_', ' ', $row->type));
            })

            // DESCRIPTION (POTONG BIAR TIDAK PANJANG)
            ->addColumn('description', function ($row) {
                return \Str::limit(strip_tags($row->description), 80);
            })

            // ACTION (POLA ADVANTAGE ✔)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '
                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm round"
                        href="'.route('backsite.tour-detail.edit', [$row->id_tour, $row->id]).'">
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
        if (!empty(session('error_msg'))) {
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        }

        if (!empty(session('success'))) {
            Alert::success('Success !', session('success'));
        }

        $tour = Tour::findOrFail($idTour);

        $types = [
            'schedule'      => 'Schedule',
            'inclusion'     => 'Inclusion',
            'exclusion'     => 'Exclusion',
            'what_to_bring' => 'What To Bring',
        ];

        return view(
            'pages.backsite.tour-detail.create',
            compact('tour', 'types')
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
                'type' => 'required|in:schedule,inclusion,exclusion,what_to_bring',
                'description' => 'required|string',
            ]);

            $data = new TourDetail;

            $data->id_tour     = $request->id_tour;
            $data->type        = $request->type;
            $data->description = $request->description;
            $data->created_by  = auth()->user()->email;

            $data->save();
            DB::commit();

            return redirect()
                ->route('backsite.tour-detail.index', $request->id_tour)
                ->withSuccess('Successfully added Tour Detail!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with(
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
            $data = TourDetail::findOrFail($id);

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
public function edit($idTour, $idTourDetail)
{
    // Tour (WAJIB untuk blade)
    $tour = Tour::findOrFail($idTour);

    // Ambil data tour detail + relasi tour
    $data = TourDetail::with('tour')
        ->where('id_tour', $idTour)
        ->findOrFail($idTourDetail);

    // List tour (jika suatu saat mau dipakai select)
    $tours = Tour::select('id', 'title')->get();

    // Type options (STATIC)
    $types = [
        'schedule'      => 'Schedule',
        'inclusion'     => 'Inclusion',
        'exclusion'     => 'Exclusion',
        'what_to_bring' => 'What To Bring',
    ];

    return view(
        'pages.backsite.tour-detail.edit',
        compact('tour', 'data', 'tours', 'types')
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
        $data = TourDetail::findOrFail($id);

        // Authorization (optional, jika pakai gate)
        $this->authorize('validate-resource', [$data, $id]);

        // VALIDATION
        $request->validate([
            'id_tour'     => 'required|exists:tours,id',
            'type'        => 'required|in:schedule,inclusion,exclusion,what_to_bring',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $data->id_tour     = $request->id_tour;
            $data->type        = $request->type;
            $data->description = $request->description;
            $data->save();

            DB::commit();

            return redirect()
                ->route('backsite.tour-detail.index', $data->id_tour)
                ->with('success', 'Successfully updated tour detail!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR DETAIL UPDATE : ' . $e->getMessage());

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
            $data = TourDetail::findOrFail($id);

            // Authorization (WAJIB sesuai Gate)
            $this->authorize('validate-resource', [$data, $id]);

            $data->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted tour detail!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR DETAIL DESTROY : ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete data: ' . $e->getMessage(),
            ], 500);
        }
    }

}
