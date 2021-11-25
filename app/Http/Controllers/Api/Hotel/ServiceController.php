<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\HotelService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceObject;

    public function __construct()
    {
        $this->serviceObject = new HotelService();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $hotelService = $this->serviceObject->getHotelServicesByHotelId(auth()->user()->hotel_id);
            return response($hotelService, 200);
            
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(HotelService::$validateRule);
            $this->serviceObject->storeHotelService($request);
            $response = ['message' => 'New Hotel Service Created Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $service = $this->serviceObject->getHotelServices(auth()->user()->hotel_id, $id);
            //$service = HotelService::findOrFail($id);
            return response($service, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }   
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(HotelService::$validateRule);
            $this->serviceObject->updateHotelService($request, $id);
            $response = ['message' => 'Hotel Service Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }  
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->serviceObject->destroyHotelService($id);
            $response = ['message' => 'Hotel Service Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
