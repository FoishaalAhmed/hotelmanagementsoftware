<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'laundry_service_id', 'laundry_product_id', 'type', 'quantity', 'charge', 'total', 
    ];

    public function getLaundryServiceDetail(Int $laundry_service_id)
    {
        $details = $this::join('laundry_products', 'laundry_service_details.laundry_product_id', '=', 'laundry_products.id')
                         ->where('laundry_service_details.laundry_service_id', $laundry_service_id)
                         ->where('laundry_service_details.hotel_id', auth()->user()->hotel_id)
                         ->select('laundry_service_details.*', 'laundry_products.name')
                         ->get();
        return $details;
    }
}
