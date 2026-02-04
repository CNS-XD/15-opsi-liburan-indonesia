<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideBookController extends Controller
{
    /**
     * Display the guide book page
     */
    public function index()
    {
        return view('pages.frontsite.guide-book.index');
    }
}