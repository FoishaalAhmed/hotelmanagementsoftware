<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'gym_id', 'charge',
    ];

    public static $validateRule = [
        'gym_id' => ['required', 'numeric', 'min: 1'],
        'charge' => ['required', 'numeric', 'min: 1'],
    ];

    public function getGymCharges()
    {
        $charges = $this::join('gyms', 'gym_charges.gym_id', '=', 'gyms.id')
                        ->where('gym_charges.hotel_id', auth()->user()->hotel_id)
                        ->orderBy('gyms.name', 'asc')
                        ->select('gym_charges.*', 'gyms.name')
                        ->get();
        return $charges;
    }

    public function storeGymCharge(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->gym_id = $request->gym_id;
        $this->charge = $request->charge;
        $storeGymCharge = $this->save();

        $storeGymCharge
            ? session()->flash('message', 'New Gym Charge Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateGymCharge(Object $request, Object $charge)
    {
        $charge->hotel_id = auth()->user()->hotel_id;
        $charge->gym_id = $request->gym_id;
        $charge->charge = $request->charge;
        $updateGymCharge = $charge->save();

        $updateGymCharge
            ? session()->flash('message', 'Gym Charge Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyGymCharge(Object $charge)
    {
        $destroyGymCharge = $charge->delete();

        $destroyGymCharge
            ? session()->flash('message', 'Gym Charge Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
