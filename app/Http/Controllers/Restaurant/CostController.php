<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Cost;
use App\Models\MobileBank;
use Illuminate\Http\Request;

class CostController extends Controller
{
    private $costObject;

    public function __construct()
    {
        $this->costObject = new Cost();
    }

    public function index()
    {
        $costs = Cost::where('hotel_id', auth()->user()->hotel_id)->where('type', 2)->get();
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        return view('backend.restaurant.cost', compact('costs', 'banks', 'mobileBanks'));
    }

    public function store(Request $request)
    {
        $request->validate(Cost::$validateRule);
        $this->costObject->storeCost($request);
        return back();
    }

    public function edit(Cost $cost)
    {
        $costs = Cost::where('hotel_id', auth()->user()->hotel_id)->where('type', 1)->get();
        return view('backend.restaurant.cost', compact('costs', 'cost'));
    }

    public function update(Request $request, Cost $cost)
    {
        $request->validate(Cost::$validateRule);
        $this->costObject->updateCost($request, $cost);
        return redirect()->route('restaurant.costs.index');
    }

    public function destroy(Cost $cost)
    {
        $this->costObject->destroyCost($cost);
        return back();
    }
}
