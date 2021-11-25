<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\HallRent;
use Illuminate\Http\Request;

class HallRentController extends Controller
{
    protected $hallRentObject;

    public function __construct()
    {
        $this->hallRentObject = new HallRent();
    }

    public function index()
    {
        $rents = $this->hallRentObject->getHallRents();
        return view('backend.hall.rents.index', compact('rents'));
    }

    public function create()
    {
        $halls = Hall::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.hall.rents.create', compact('halls'));
    }

    public function store(Request $request)
    {
        $request->validate(HallRent::$validateRule);
        $this->hallRentObject->storeHallRents($request);
        return back();
    }

    public function edit(HallRent $rent)
    {
        $halls = Hall::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.hall.rents.edit', compact('halls', 'rent'));
    }

    public function update(Request $request, HallRent $rent)
    {
        $request->validate(HallRent::$validateRule);
        $this->hallRentObject->updateHallRents($request, $rent);
        return redirect()->route('hall.rents.index');
    }

    public function destroy(HallRent $rent)
    {
        $this->hallRentObject->destroyHallRents($rent);
        return back();
    }
}
