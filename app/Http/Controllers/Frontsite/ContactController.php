<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Faq;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.frontsite.Contact.index');
    }
}
