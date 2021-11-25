<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FacilityRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'room_id', 'facility_id', 'charge',
    ];

    public function getAllRoomFacilities()
    {
        $roomFacilities = $this::join('rooms', 'facility_rooms.room_id', '=', 'rooms.id')
            ->join('facilities', 'facility_rooms.facility_id', '=', 'facilities.id')
            ->where('facility_rooms.hotel_id', auth()->user()->hotel_id)
            ->select('facility_rooms.id', 'facility_rooms.charge', 'facilities.name as facility', 'rooms.number')
            ->get();
        return $roomFacilities;
    }

    public function getRoomFacilities(Int $room_id)
    {
        $facilities = DB::table('facility_rooms')
        ->join('facilities', 'facility_rooms.facility_id', '=', 'facilities.id')
        ->select('facilities.name')
        ->where('facility_rooms.room_id', $room_id)
            ->orderBy('facilities.name')
            ->get();
        return $facilities;
    }

    public function storeroomFacility(Object $request)
    {
        if ($request->charge != null) {
            foreach ($request->charge as $key => $value) {
                if ($value == null || $request->facility_id[$key] == null) continue;
                $roomFacility             = new FacilityRoom();
                $roomFacility->hotel_id   = auth()->user()->hotel_id;
                $roomFacility->room_id   = $request->room_id;
                $roomFacility->facility_id = $request->facility_id[$key];
                $roomFacility->charge     = $value;
                $storeroomFacility        = $roomFacility->save();
            }
        }

        isset($storeroomFacility)
            ? session()->flash('message', 'Room Facility Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateRoomFacility(Object $request, Int $id)
    {
        $roomFacility             = $this::findOrFail($id);
        $roomFacility->hotel_id   = auth()->user()->hotel_id;
        $roomFacility->room_id   = $request->room_id;
        $roomFacility->facility_id = $request->facility_id;
        $roomFacility->charge     = $request->charge;
        $updateRoomFacility       = $roomFacility->save();

        $updateRoomFacility
            ? session()->flash('message', 'Room Facility Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyRoomFacility($id)
    {
        $roomFacility = $this::findOrFail($id);
        $destroyRoomFacility = $roomFacility->delete();

        $destroyRoomFacility
            ? session()->flash('message', 'Room Facility Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
