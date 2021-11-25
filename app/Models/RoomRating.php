<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'hotel_id', 'room_review_category_id', 'rating',
    ];

    public static $validateRule = [
        'hotel_id' => ['required', 'numeric'],
        'room_id' => ['required', 'numeric'],
        'room_review_category_id.*' => ['required', 'numeric'],
        'rating.*' => ['nullable', 'numeric'],
    ];

    public function storeRoomRating(Object $request)
    {
        if ($request->rating != null) {
            foreach ($request->rating as $key => $value) {
                if ($value == null) continue;
                $data[] = [
                    'user_id' => auth()->id(),
                    'hotel_id' => $request->hotel_id,
                    'room_id' => $request->room_id,
                    'room_review_category_id' => $request->room_review_category_id[$key],
                    'rating' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            $this::insert($data);
        }

        if ($request->review != null) {
            $review = new RoomReview();

            $review->user_id = auth()->id();
            $review->hotel_id = $request->hotel_id;
            $review->room_id = $request->room_id;
            $review->review = $request->review;
            $review->save();
        }
        session()->flash('message', 'Rating Successfully Done!');
    }
}
