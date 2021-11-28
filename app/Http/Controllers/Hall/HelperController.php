<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\HallRent;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function rent(Request $request)
    {
        $rent = HallRent::where('hotel_id', auth()->user()->hotel_id)->where('type', $request->type)->where('hall_id', $request->hall_id)->select('rent')->first();
        
        echo json_encode($rent);
    }
}
