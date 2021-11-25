<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\RoomType;
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
        $rooms = Room::where('hotel_id', auth()->user()->id)->orderBy('number', 'asc')->get();
        return view('backend.admin.room.index', compact('rooms'));
    }

    public function create()
    {
        $types = RoomType::where('hotel_id', auth()->user()->hotel_id)->select('type')->get();
        return view('backend.admin.room.create', compact('types'));
    }

    public function store(RoomRequest $request)
    {
        $this->roomObject->storeRoom($request);
        return back();
    }

    public function edit($id)
    {
        $room       = Room::findOrFail($id);
        $roomVideos = RoomVideo::where('room_id', $id)->get();
        $roomPhotos = RoomPhoto::where('room_id', $id)->get();
        $types = RoomType::where('hotel_id', auth()->user()->hotel_id)->select('type')->get();

        return view('backend.admin.room.edit', compact('roomVideos', 'roomPhotos', 'room', 'types'));
    }

    public function update(RoomRequest $request, $id)
    {
        $this->roomObject->updateRoom($request, $id);
        return redirect()->route('admin.rooms.index');
    }

    public function destroy($id)
    {
        $this->roomObject->destroyRoom($id);
        return back();
    }
}
