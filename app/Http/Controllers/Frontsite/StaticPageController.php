<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;

class StaticPageController extends Controller
{
    public function termsConditions()
    {
        return view('pages.frontsite.terms-conditions.index');
    }

    public function privacyPolicy()
    {
        return view('pages.frontsite.privacy-policy.index');
    }
}