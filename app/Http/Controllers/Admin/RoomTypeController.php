<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    private $roomTypeObject;

    public function __construct()
    {
        $this->roomTypeObject = new RoomType();
    }

    public function index()
    {
        $types = RoomType::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.roomType', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate(RoomType::$validateRule);
        $this->roomTypeObject->storeRoomType($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(RoomType::$validateRule);
        $this->roomTypeObject->updateRoomType($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->roomTypeObject->destroyRoomType($id);
        return back();
    }
}