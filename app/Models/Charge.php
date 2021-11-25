<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'category', 'charge', 'type',
    ];

    public static $validateRule = [
        'category' => ['required', 'numeric'],
        'type' => ['required', 'string', 'max:10'],
        'charge' => ['required', 'numeric'],
    ];

    public function getParkingCharges()
    {
        $charges = $this::join('vehicle_categories', 'charges.category', '=', 'vehicle_categories.id')
            ->orderBy('charges.created_at', 'desc')
            ->where('charges.hotel_id', auth()->user()->hotel_id)
            ->select('charges.*', 'vehicle_categories.name')
            ->get();
        return $charges;
    }

    public function storeCharge(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->category = $request->category;
        $this->type = $request->type;
        $this->charge = $request->charge;
        $storeCharge = $this->save();

        $storeCharge
            ? session()->flash('message', 'New Parking Charge Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateCharge(Object $request, Int $id)
    {
        $charge = $this::findOrFail($id);
        $charge->hotel_id = auth()->user()->hotel_id;
        $charge->category = $request->category;
        $charge->type = $request->type;
        $charge->charge = $request->charge;
        $updateCharge = $charge->save();

        $updateCharge
            ? session()->flash('message', 'Parking Charge Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyCharge(Int $id)
    {
        $charge = $this::findOrFail($id);
        $destroyCharge = $charge->delete();

        $destroyCharge
            ? session()->flash('message', 'Parking Charge Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
