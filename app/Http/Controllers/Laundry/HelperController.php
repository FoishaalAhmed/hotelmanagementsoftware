<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryCharge;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function charge(Request $request)
    {
        $charge = LaundryCharge::where('laundry_product_id', $request->laundry_product_id)->where('type', $request->type)->first()->charge;
        echo json_encode($charge);
    }
}
