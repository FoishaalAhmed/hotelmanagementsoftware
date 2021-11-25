<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomFacilityController extends Controller
{
    private $roomFacilityObject;

    public function __construct()
    {
        $this->roomFacilityObject = new FacilityRoom();
    }

    public function returnRoomAndFacility()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->select('id', 'number')->get();
        $facility = Facility::select('id', 'name')->get();
        $response     = ['facility' => $facility, 'rooms' => $rooms];
        return response()->json($response, 200);
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $roomFacilities = $this->roomFacilityObject->getAllRoomFacilities();
            return response()->json($roomFacilities, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->roomFacilityObject->storeRoomFacility($request);
            $response = ['message' => 'New Room Facility Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $roomFacility = FacilityRoom::findOrFail($id);
            $facility     = Facility::select('id', 'name')->get();
            $rooms        = Room::where('hotel_id', $roomFacility->hotel_id)->get();
            $response     = ['roomFacility' => $roomFacility, 'facility' => $facility, 'rooms' => $rooms];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->roomFacilityObject->updateRoomFacility($request, $id);
            $response = ['message' => 'Room Facility Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->roomFacilityObject->destroyRoomFacility($id);
            $response = ['message' => 'Room Facility Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
