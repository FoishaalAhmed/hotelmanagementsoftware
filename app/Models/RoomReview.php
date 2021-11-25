<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'hotel_id', 'room_id', 'status', 'review',
    ];

    public function getRoomReview(Int $hotel_id)
    {
        $reviews = $this::join('users', 'room_reviews.user_id', '=', 'users.id')
            ->join('hotel_ratings', 'users.id', '=', 'hotel_ratings.user_id')
            ->where('room_reviews.hotel_id', $hotel_id)
            ->orderBy('room_reviews.created_at', 'desc')
            ->where('room_reviews.status', 1)
            ->select('users.name', 'users.photo', 'room_reviews.review', 'room_reviews.created_at', 'hotel_ratings.rating')
            ->take(3)
            ->get();
        return $reviews;
    }

    public function getAllRoomReview()
    {
        $reviews = $this::join('users', 'room_reviews.user_id', '=', 'users.id')
            ->orderBy('room_reviews.created_at', 'desc')
            ->select('users.name', 'users.photo', 'room_reviews.*')
            ->get();
        return $reviews;
    }
}
