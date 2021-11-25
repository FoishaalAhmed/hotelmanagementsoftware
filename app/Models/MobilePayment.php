<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobilePayment extends Model
{
    protected $fillable = [
        'booking_id', 'mobile_number', 'method', 'transaction_id', 'amount',
    ];
}
