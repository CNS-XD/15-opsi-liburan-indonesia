<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('show', Faq::SHOW['publish'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.frontsite.faq.index', compact('faqs'));
    }
}
