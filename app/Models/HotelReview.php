<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'hotel_id', 'review',
    ];

    public function getHotelReview(Int $hotel_id)
    {
        $reviews = $this::join('users', 'hotel_reviews.user_id', '=', 'users.id')
            ->join('hotel_ratings', 'users.id', '=', 'hotel_ratings.user_id')
            ->where('hotel_reviews.hotel_id', $hotel_id)
            ->orderBy('hotel_reviews.created_at', 'desc')
            ->where('hotel_reviews.status', 1)
            ->select('users.name', 'users.photo', 'hotel_reviews.review', 'hotel_reviews.created_at', 'hotel_ratings.rating')
            ->take(3)
            ->get();
        return $reviews;
    }

    public function getAllHotelReview()
    {
        $reviews = $this::join('users', 'hotel_reviews.user_id', '=', 'users.id')
            ->orderBy('hotel_reviews.created_at', 'desc')
            ->select('users.name', 'users.photo', 'hotel_reviews.*')
            ->get();
        return $reviews;
    }
}
