<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{
    protected $fillable = [
        'booking_id', 'method', 'bank', 'card_number', 'cheque_number', 'cheque_date', 'acc_number', 'deposited_acc_number', 'amount', 
    ];
}
