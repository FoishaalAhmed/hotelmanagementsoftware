<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'laundry_product_id', 'type', 'charge',
    ];

    public static $validateRule = [
        'laundry_product_id' => ['required', 'numeric', 'min:1'],
        'type' => ['required', 'string', 'max:20'],
        'charge' => ['required', 'numeric', 'min:1'],
    ];

    public function getLaundryCharges()
    {
        $charges = $this::join('laundry_products', 'laundry_charges.laundry_product_id', '=', 'laundry_products.id')
            ->where('laundry_charges.hotel_id', auth()->user()->hotel_id)
            ->orderBy('laundry_products.name', 'asc')
            ->select('laundry_products.name', 'laundry_charges.*')
            ->get();
        return $charges;
    }

    public function storeLaundryCharge(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->laundry_product_id = $request->laundry_product_id;
        $this->type = $request->type;
        $this->charge = $request->charge;
        $storeLaundryCharge = $this->save();

        $storeLaundryCharge
            ? session()->flash('message', 'Laundry Charge Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateLaundryCharge(Object $request, Object $charge)
    {
        $charge->hotel_id = auth()->user()->hotel_id;
        $charge->laundry_product_id = $request->laundry_product_id;
        $charge->type = $request->type;
        $charge->charge = $request->charge;
        $updateLaundryCharge = $charge->save();

        $updateLaundryCharge
            ? session()->flash('message', 'Laundry Charge Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyLaundryCharge(Object $charge)
    {
        $destroyLaundryCharge = $charge->delete();

        $destroyLaundryCharge
            ? session()->flash('message', 'Laundry Charge Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
