<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebManagementController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        
        return view('backend.management.dashboard');
    }
}
