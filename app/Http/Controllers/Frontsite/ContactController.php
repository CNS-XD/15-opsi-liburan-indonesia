<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\ContactGeneral;
use App\Models\ContactSocmed;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactGeneral = ContactGeneral::first();
        $contactSocmeds = ContactSocmed::orderBy('created_at', 'asc')->get();

        return view('pages.frontsite.contact.index', compact('contactGeneral', 'contactSocmeds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactGeneral::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
