<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelPhoto extends Model
{
    protected $fillable = [
        'hotel_id', 'photo',
    ];
}
