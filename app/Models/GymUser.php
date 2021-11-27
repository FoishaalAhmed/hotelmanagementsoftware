<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'booking_id', 'room_id', 'gym_id',
    ];

    public static $validateRule = [
        'room_id' => ['required', 'numeric', 'min: 1'],
        'gym_id' => ['required', 'numeric', 'min: 1'],
    ];

    public function getGymUsers()
    {
        $users = $this->join('rooms', 'gym_users.room_id', '=', 'rooms.id')
            ->join('gyms', 'gym_users.gym_id', '=', 'gyms.id')
            ->where('gym_users.hotel_id', auth()->user()->hotel_id)
            ->orderBy('gym_users.id', 'desc')
            ->select('gym_users.id', 'rooms.number', 'gyms.name')
            ->get();

        return $users;
    }

    public function storeGymUser(Object $request)
    {
        $booking_id = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->latest()->firstOrFail()->booking_id;
        $this->hotel_id = auth()->user()->hotel_id;
        $this->booking_id = $booking_id;
        $this->room_id = $request->room_id;
        $this->gym_id = $request->gym_id;
        $storeGymUser = $this->save();

        $storeGymUser
            ? session()->flash('message', 'New Gym User Info Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong');
    }

    public function destroyGymUser(Object $user)
    {
        $destroyGymUser = $user->delete();

        $destroyGymUser
            ? session()->flash('message', 'Gym User Info Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong');
    }
}
