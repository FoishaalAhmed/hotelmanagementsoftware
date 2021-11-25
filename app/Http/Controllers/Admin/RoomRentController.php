<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomRent;
use Illuminate\Http\Request;

class RoomRentController extends Controller
{
    private $roomRentObject;

    public function __construct()
    {
        $this->roomRentObject = new RoomRent();
    }

    public function index()
    {
        $rents = $this->roomRentObject->getRoomRents();
        return view('backend.admin.roomRent.index', compact('rents'));
    }

    public function create()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->select('id', 'number')->orderBy('number', 'asc')->get();
        return view('backend.admin.roomRent.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate(RoomRent::$validateRule);
        $this->roomRentObject->storeRoomRent($request);
        return back();
    }

    public function edit($id)
    {
        $rent = RoomRent::findOrFail($id);
        $rooms = Room::select('id', 'number')->orderBy('number', 'asc')->get();
        return view('backend.admin.roomRent.create', compact('rooms', 'rent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(RoomRent::$validateRule);
        $this->roomRentObject->updateRoomRent($request, $id);
        return redirect()->route('admin.room-rents.index');
    }

    public function destroy($id)
    {
        $this->roomRentObject->destroyRoomRent($id);
        return redirect()->route('admin.room-rents.index');
    }
}
