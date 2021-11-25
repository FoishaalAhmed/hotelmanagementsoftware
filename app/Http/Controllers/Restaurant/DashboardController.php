<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.restaurant.dashboard');
    }
}
