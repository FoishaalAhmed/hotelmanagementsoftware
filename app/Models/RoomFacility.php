<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoomFacility extends Model
{
    protected $fillable = [
        'room_id', 'facility_id',
    ];

    
}
