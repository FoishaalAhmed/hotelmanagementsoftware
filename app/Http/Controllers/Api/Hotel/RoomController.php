<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\RoomVideo;

class RoomController extends Controller
{
    private $roomObject;

    public function __construct()
    {
        $this->roomObject = new Room();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $rooms = Room::where('hotel_id', auth()->user()->id)->orderBy('number', 'asc')->get();
            return response()->json($rooms, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(RoomRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->roomObject->storeRoom($request);
            $response = ['message' => 'New Room Info Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $room       = Room::findOrFail($id);
            $roomVideos = RoomVideo::where('Hotel_id', $id)->get();
            $roomPhotos = RoomPhoto::where('Hotel_id', $id)->get();

            $response = [
                'room' => $room,
                'roomVideos' => $roomVideos,
                'roomPhotos' => $roomPhotos,
            ];

            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(RoomRequest $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->roomObject->updateRoom($request, $id);
            $response = ['message' => 'Room Info Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->roomObject->destroyRoom($id);
            $response = ['message' => 'Room Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
