<?php

namespace App\Http\Controllers\Api\Tour;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Guide;
use App\Models\GuideCharge;
use App\Models\Room;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function GuidePackageAndBookedRoomInfo()
    {
        $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();

        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();

        $response= [
            'guides' => $guides,
            'packages' => $packages,
            'rooms' => $rooms,
        ];

        return response($response, 200);
    }

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
