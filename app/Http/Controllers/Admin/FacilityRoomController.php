<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class FacilityRoomController extends Controller
{
    private $roomFacilityObject;

    public function __construct()
    {
        $this->roomFacilityObject = new FacilityRoom();
    }

    public function index()
    {
        $roomFacilities = $this->roomFacilityObject->getAllRoomFacilities();
        return view('backend.admin.roomFacilities.index', compact('roomFacilities'));
    }

    public function create()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->select('id', 'number')->get();
        $facility = Facility::select('id', 'name')->get();
        return view('backend.admin.roomFacilities.create', compact('facility', 'rooms'));
    }

    public function store(Request $request)
    {
        $this->roomFacilityObject->storeRoomFacility($request);
        return back();
    }

    public function edit($id)
    {
        $roomFacility = FacilityRoom::findOrFail($id);
        $facility     = Facility::select('id', 'name')->get();
        $rooms        = Room::where('hotel_id', $roomFacility->hotel_id)->get();
        return view('backend.admin.roomFacilities.edit', compact('facility', 'roomFacility', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $this->roomFacilityObject->updateRoomFacility($request, $id);
        return redirect()->route('admin.room-facilities.index');
    }

    public function destroy($id)
    {
        $this->roomFacilityObject->destroyRoomFacility($id);
        return back();
    }
}
