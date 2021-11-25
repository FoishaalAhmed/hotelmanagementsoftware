<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.parking.dashboard');
    }
}
