<?php

namespace App\Http\Controllers\Gym;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\GymCharge;
use Illuminate\Http\Request;

class GymChargeController extends Controller
{
    protected $gymChargeObject;

    public function __construct()
    {
        $this->gymChargeObject = new GymCharge();
    }

    public function index()
    {
        $charges = $this->gymChargeObject->getGymCharges();
        return view('backend.gym.charges.index', compact('charges'));
    }

    public function create()
    {
        $gyms = Gym::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.gym.charges.create', compact('gyms'));
    }

    public function store(Request $request)
    {
        $request->validate(GymCharge::$validateRule);
        $this->gymChargeObject->storeGymCharge($request);
        return back();
    }

    public function edit(GymCharge $charge)
    {
        $gyms = Gym::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.gym.charges.edit', compact('gyms', 'charge'));
    }

    public function update(Request $request, GymCharge $charge)
    {
        $request->validate(GymCharge::$validateRule);
        $this->gymChargeObject->updateGymCharge($request, $charge);
        return redirect()->route('gym.charges.index');
    }

    public function destroy(GymCharge $charge)
    {
        $this->gymChargeObject->destroyGymCharge($charge);
        return back();
    }
}
