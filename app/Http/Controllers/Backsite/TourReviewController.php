<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourReviewRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TourReview;
use App\Models\Tour;

class TourReviewController extends Controller
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

        return view('pages.backsite.tour-review.index', compact('tour'));
    }




    public function datatable($idTour)
    {
        $data = TourReview::where('id_tour', $idTour)->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            // NAME
            ->addColumn('name', function ($row) {
                return $row->name;
            })

            // RATING (⭐⭐⭐⭐⭐)
            ->addColumn('rating', function ($row) {
                $star = '';
                for ($i = 1; $i <= 5; $i++) {
                    $star .= $i <= $row->rating
                        ? '<i class="la la-star text-warning"></i>'
                        : '<i class="la la-star-o text-muted"></i>';
                }
                return $star;
            })

            // DESCRIPTION (SHORT)
            ->addColumn('description', function ($row) {
                return Str::limit(strip_tags($row->description), 80);
            })

            // STATUS SHOW
            ->addColumn('show', function ($row) {
                if ($row->show == 1) {
                    return '<span class="badge badge-success">Show</span>';
                }
                return '<span class="badge badge-secondary">Hidden</span>';
            })

            // ACTION
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-group">
                        <a href="'.route('backsite.tour-review.edit', [$row->id_tour, $row->id]).'"
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

            ->rawColumns(['rating', 'show', 'action'])
            ->make(true);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idTour)
    {
        // Alert (tetap dipakai)
        if (!empty(session('error_msg'))) {
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        }

        if (!empty(session('success'))) {
            Alert::success('Success !', session('success'));
        }

        // Ambil tour (WAJIB)
        $tour = Tour::findOrFail($idTour);

        // Tidak ada $types / data lain (khusus Tour Review)

        return view(
            'pages.backsite.tour-review.create',
            compact('tour')
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourReviewRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                'id_tour'     => $request->id_tour,
                'name'        => $request->name,
                'description' => $request->description,
                'rating'      => $request->rating,
                'show'        => $request->show,
            ];

            // Upload image (optional)
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')
                    ->store('tour-review', 'public');
            }

            TourReview::create($data);

            DB::commit();

            return redirect()
                ->route('backsite.tour-review.index', $request->id_tour)
                ->with('success', 'Successfully added review!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR REVIEW STORE : ' . $e->getMessage());

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
            $data = TourReview::findOrFail($id);

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
    public function edit($idTour, $idTourReview)
    {
        // Alert (konsisten dengan create)
        if (!empty(session('error_msg'))) {
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        }

        if (!empty(session('success'))) {
            Alert::success('Success !', session('success'));
        }

        // 1. Ambil tour (breadcrumb & back button)
        $tour = Tour::findOrFail($idTour);

        // 2. Ambil tour review + pastikan milik tour tsb
        $data = TourReview::where('id_tour', $idTour)
            ->findOrFail($idTourReview);

        return view(
            'pages.backsite.tour-review.edit',
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
    public function update(TourReviewRequest $request, $id)
    {
        $data = TourReview::findOrFail($id);

        // Authorization (optional)
        // $this->authorize('validate-resource', [$data, $id]);

        DB::beginTransaction();

        try {
            $update = [
                'name'        => $request->name,
                'description' => $request->description,
                'rating'      => $request->rating,
                'show'        => $request->show,
            ];

            // Replace image jika upload baru
            if ($request->hasFile('image')) {
                if ($data->image) {
                    Storage::disk('public')->delete($data->image);
                }

                $update['image'] = $request->file('image')
                    ->store('tour-review', 'public');
            }

            $data->update($update);

            DB::commit();

            return redirect()
                ->route('backsite.tour-review.index', $data->id_tour)
                ->with('success', 'Successfully updated review!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR REVIEW UPDATE : ' . $e->getMessage());

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
            $data = TourReview::findOrFail($id);

            // Authorization (optional)
            // $this->authorize('validate-resource', [$data, $id]);

            // Hapus image jika ada
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }

            $data->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Review deleted!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERROR TOUR REVIEW DELETE : ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete review',
            ], 500);
        }
    }

}
