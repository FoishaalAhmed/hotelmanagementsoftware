<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\GuideCharge;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function get_charge_by_type(Request $request)
    {
        $charge = GuideCharge::where('guide_id', $request->guide_id)->where('type', $request->type)->first()->charge;
        echo json_encode($charge);
    }

    public function get_charge_by_package(Request $request)
    {
        $charge = GuideCharge::where('guide_id', $request->guide_id)->where('tour_package_id', $request->package_id)->first()->charge;
        $duration = TourPackage::where('id', $request->package_id)->first()->duration;
        $response = [
            'charge' => $charge,
            'duration' => $duration,
        ];
        echo json_encode($response);
    }
}
