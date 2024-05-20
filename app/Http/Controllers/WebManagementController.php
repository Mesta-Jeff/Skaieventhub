<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebManagementController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        return view('backend.management.dashboard');
    }
}
