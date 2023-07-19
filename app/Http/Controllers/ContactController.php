<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'seeker']);
    }
    public function showContact()
    {

        return view('profile.contact');
    }
}
