<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //

    public function index()
    {
        return view('index');
    }

    public function contact_us()
    {
        return view('contact-us');
    }
}
