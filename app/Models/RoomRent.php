<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRent extends Model
{
    protected $fillable = [
        'room_id', 'type', 'rent',
    ];

    public static $validateRule = [
        'room_id' => ['required', 'numeric'],
        'type' => ['required', 'string', 'max:255'],
        'rent' => ['required', 'numeric'],
    ];

    public function getRoomRents()
    {
        $rents = $this::join('rooms', 'room_rents.room_id', '=', 'rooms.id')
                        ->orderBy('rooms.number', 'asc')
                        ->select('room_rents.*', 'rooms.number')
                        ->get();
        return $rents;
    }
    
    public function getRoomRent($id)
    {
        $rents = $this::join('rooms', 'room_rents.room_id', '=', 'rooms.id')
                        ->where('room_rents.id', $id)
                        ->select('room_rents.*', 'rooms.number')
                        ->firstOrFail();
        return $rents;
    }

    public function storeRoomRent(Object $request)
    {
        $this->room_id = $request->room_id;
        $this->type = $request->type;
        $this->rent = $request->rent;
        $storeRoomRent = $this->save();

        $storeRoomRent
            ? session()->flash('message', 'Room Rent Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateRoomRent(Object $request, Int $id)
    {
        $rent = $this->findOrFail($id);
        $rent->room_id = $request->room_id;
        $rent->type = $request->type;
        $rent->rent = $request->rent;
        $updateRoomRent = $rent->save();

        $updateRoomRent
            ? session()->flash('message', 'Room Rent Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyRoomRent(Int $id)
    {
        $rent = $this->findOrFail($id);
        $destroyRoomRent = $rent->delete();

        $destroyRoomRent
            ? session()->flash('message', 'Room Rent Destroyed Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
