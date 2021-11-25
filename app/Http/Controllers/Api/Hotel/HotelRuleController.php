<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\HotelRule;
use Illuminate\Http\Request;

class HotelRuleController extends Controller
{
    private $hotelRuleObject;

    public function __construct()
    {
        $this->hotelRuleObject = new HotelRule();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $rule = HotelRule::where('hotel_id', auth()->user()->hotel_id)->firstOrFail();
            return response()->json($rule, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, HotelRule $HotelRule)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(HotelRule::$validateRule);
            $this->hotelRuleObject->updateHotelRule($request, $HotelRule);
            $response = ['message' => 'Hotel Rule Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
