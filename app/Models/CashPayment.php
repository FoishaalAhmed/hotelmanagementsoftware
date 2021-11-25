<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    protected $fillable = [
        'booking_id', 'date', 'invoice', 'paid', 
    ];
}
