<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\TourRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tour;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
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
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.tour.index');
    }

    public function datatable()
    {
        $data = Tour::latest();

        return DataTables::of($data)
            ->addIndexColumn()

            // Action
            ->addColumn('action', function ($data) {
                return '
                <div class="btn-group mr-1 mb-1">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-list"></i>
                    </button>
                    <div class="dropdown-menu overflow-hidden">
                        <a class="dropdown-item" href="'.route('backsite.tour.edit', $data->id).'">Edit</a>
                        <a class="dropdown-item" onclick="deleteConf('.$data->id.')">Hapus</a>
                    </div>
                </div>
                ';
            })

            // Image
            ->editColumn('image', function ($data) {
                if ($data->image) {
                    return '<img src="'.asset('storage/'.$data->image).'" width="80">';
                }
                return '<img src="'.asset('backsite-assets/images/no-image-available.jpg').'" width="80">';
            })

            // Title  
            ->editColumn('title', function ($data) {
                return $data->title;
            })

            // Type Tour
            ->editColumn('type_tour', function ($data) {
                return $data->type_tour == 1 ? 'Sharing Tour' : 'Private Tour';
            })

            // Price
            ->editColumn('price', function ($data) {
                return '$ ' . $data->price;
            })

            // Is Best
            ->editColumn('is_best', function ($data) {
                return $data->is_best == 1
                    ? '<span class="badge badge-success">Yes</span>'
                    : '<span class="badge badge-danger">No</span>';
            })

            // Show Toggle
            ->editColumn('show', function ($data) {
                $checked = $data->show ? 'checked' : '';
                return '
                    <label class="pure-material-switch">
                        <input type="checkbox" '.$checked.' onchange="setShow('.$data->id.')">
                        <span></span>
                    </label>
                ';
            })

            // Departures
            ->addColumn('departures', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-departure.index', $data->id) . '">
                        Departures
                    </a>
                ';
            })

            // Destinations
            ->addColumn('destinations', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-destination.index', $data->id) . '">
                        Destinations
                    </a>
                ';
            })

            // Details
            ->addColumn('details', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-detail.index', $data->id) . '">
                        Details
                    </a>
                ';
            })

            // Photos
            ->addColumn('photos', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-photo.index', $data->id) . '">
                        Photos
                    </a>
                ';
            })

            // Prices
            ->addColumn('prices', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-price.index', $data->id) . '">
                        Prices
                    </a>
                ';
            })

            // Reviews
            ->addColumn('reviews', function ($data) {
                return '
                    <a class="btn btn-secondary btn-sm round" href="' . route('backsite.tour-review.index', $data->id) . '">
                        Reviews
                    </a>
                ';
            })

            ->rawColumns(['action', 'image', 'is_best', 'show', 'departures', 'destinations', 'details', 'photos', 'prices', 'reviews'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        return view('pages.backsite.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = new Tour;

            // Cek apakah slug sudah ada di database
            $originalSlug = Str::slug($request->title, '-');
            $slug = generateUniqueSlugBlog($originalSlug, null);
            
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/tour');
                $data->image = $image;
            }
            $data->title        = $request->title;
            $data->description  = $request->description;
            $data->day_tour     = $request->day_tour;
            $data->time_tour    = $request->time_tour;
            $data->type_tour    = $request->type_tour;
            $data->price        = $request->price;
            $data->is_best      = $request->is_best;
            $data->group_size   = $request->group_size;
            $data->level_tour   = $request->level_tour;
            $data->show         = $request->show;
            $data->slug         = $slug;
            $data->save();
            DB::commit();

            return redirect()->route('backsite.tour.index')->withSuccess('Successfully added data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to add data: ' . $e->getMessage());
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
            $data = Tour::findOrFail($id);

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
    public function edit($id)
    {
        $this->authorize('validate-resource', [(new Tour), $id]);

        $data['data'] = Tour::findOrFail($id);
        return view('pages.backsite.tour.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        $this->authorize('validate-resource', [(new Tour), $id]);
    
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
    
            // Optimasi slug
            $originalSlug = Str::slug($request->title, '-');
            $slug = generateUniqueSlugBlog($originalSlug, $id);
    
            // Update data
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->image, '/tour');

                if (is_file(storage_path("app/public/" . $data->image))) {
                    Storage::disk('public')->delete($data->image);
                }

                $data->image = $image;
            }
            $data->title        = $request->title;
            $data->description  = $request->description; 
            $data->day_tour     = $request->day_tour;
            $data->time_tour    = $request->time_tour;
            $data->type_tour    = $request->type_tour;
            $data->price        = $request->price;
            $data->is_best      = $request->is_best;
            $data->group_size   = $request->group_size;
            $data->level_tour   = $request->level_tour;
            $data->show         = $request->show;
            $data->slug         = $slug;
            $data->save();
            DB::commit();
    
            return redirect()->route('backsite.tour.index')->withSuccess('Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to change data' . $e->getMessage());
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
        $this->authorize('validate-resource', [(new Tour), $id]);
    
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
            if (is_file(storage_path("app/public/" . $data->image)))
                Storage::disk('public')->delete($data->image);

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

    public function setShow($id)
    {
        $this->authorize('validate-resource', [(new Tour), $id]);
        
        DB::beginTransaction();
        try {
            $data = Tour::findOrFail($id);
            $data->update([
                'show' => $data->show == Tour::SHOW['draft'] ? Tour::SHOW['publish'] : Tour::SHOW['draft']
            ]);
            DB::commit();

            $this->success = \Illuminate\Http\Response::HTTP_OK;
            $this->message = 'Status updated successfully!';
        } catch (\Exception $e) {
            $this->success = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message = 'Status failed to update!';
            Log::error("ERROR APP : " . $e->getMessage());
        }

        return $this->json();
    }
}
