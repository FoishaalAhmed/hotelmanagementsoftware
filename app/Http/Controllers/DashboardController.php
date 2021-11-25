<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->roles);
        if (auth()->user()->hasRole('Hotel')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('restaurant.dashboard');
        }
    }
}
