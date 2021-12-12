<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryCharge;
use App\Models\LaundryProduct;
use Illuminate\Http\Request;

class LaundryChargeController extends Controller
{
    protected $laundryChargeObject;

    public function __construct()
    {
        $this->laundryChargeObject = new LaundryCharge();
    }

    public function index()
    {
        $charges = $this->laundryChargeObject->getLaundryCharges();
        return view('backend.laundry.charges.index', compact('charges'));
    }

    public function create()
    {
        $products = LaundryProduct::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.laundry.charges.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate(LaundryCharge::$validateRule);
        $this->laundryChargeObject->storeLaundryCharge($request);
        return back();
    }

    public function edit(LaundryCharge $charge)
    {
        $products = LaundryProduct::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.laundry.charges.edit', compact('products', 'charge'));
    }

    public function update(Request $request, LaundryCharge $charge)
    {
        $request->validate(LaundryCharge::$validateRule);
        $this->laundryChargeObject->updateLaundryCharge($request, $charge);
        return redirect()->route('laundry.charges.index');
    }

    public function destroy(LaundryCharge $charge)
    {
        $this->laundryChargeObject->destroyLaundryCharge($charge);
        return back();
    }
}
