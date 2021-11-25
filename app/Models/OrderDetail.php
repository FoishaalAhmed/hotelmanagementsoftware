<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'hotel_id', 'invoice', 'item_id', 'quantity', 'price', 'total',
    ];

    public function getOrderDetailByOrderID(Int $order_id)
    {
        $details = $this->join('items', 'order_details.item_id', '=', 'items.id')
            ->where('order_details.hotel_id', auth()->user()->hotel_id)
            ->where('order_details.order_id', $order_id)
            ->select('order_details.*', 'items.name')
            ->get();
        return $details;
    }
}
