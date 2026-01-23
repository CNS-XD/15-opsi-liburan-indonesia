<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\BookingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Booking;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
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
        
        $data['data'] = Booking::first();

        return view('pages.backsite.booking.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $query = Booking::with([
                'tour:id,title',
                'tourPrice:id,price'
            ])
            ->select('bookings.*')
            ->latest('created_at');

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('tour', function ($row) {
                return optional($row->tour)->title ?? '-';
            })

            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format(optional($row->tourPrice)->price ?? 0);
            })

            ->addColumn('order_date', function ($row) {
                return $row->order_date;
            })

            ->addColumn('created_by', function ($row) {
                return $row->created_by ?? '-';
            })

            ->addColumn('created_at', function ($row) {
                // accessor dari model Booking
                return $row->created_at ?? '-';
            })

            ->make(true);
    }

}