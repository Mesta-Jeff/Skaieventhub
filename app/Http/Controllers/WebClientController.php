<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebClientController extends Controller
{
    //
    public function dashboard(Request $request)
    {

        return view('backend.clients.dashboard');
    }
}
