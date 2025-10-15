<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\DivisiKompetisi;
use App\Models\InfoPengumuman;
use App\Models\InfoUnduhan;
use App\Models\InfoSponsor;
use App\Models\InfoBerita;
use App\Models\InfoGaleri;
use App\Models\InfoVideo;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.frontsite.index');
    }
}
