<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelVideo extends Model
{
    protected $fillable = [
        'hotel_id', 'video',
    ];
}
