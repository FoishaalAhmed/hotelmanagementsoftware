<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'tour_id', 'booking_id', 'room_id', 'person', 'names', 'paid',
    ];

    public function getTourUsers(Int $tour_id)
    {
        $users = $this::join('rooms', 'tour_users.room_id', '=', 'rooms.id')
            ->where('tour_users.tour_id', $tour_id)
            ->where('tour_users.hotel_id', auth()->user()->hotel_id)
            ->select('tour_users.*', 'rooms.number')
            ->get();
        return $users;
    }
}
