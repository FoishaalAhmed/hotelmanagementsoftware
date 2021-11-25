<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelRule;
use Illuminate\Http\Request;

class HotelRuleController extends Controller
{
    private $hotelRuleObject;

    public function __construct()
    {
        $this->hotelRuleObject = new HotelRule();
    }

    public function index()
    {
        $rule = HotelRule::where('hotel_id', auth()->user()->hotel_id)->firstOrFail();
        return view('backend.admin.hotelRule', compact('rule'));
    }

    public function update(Request $request, HotelRule $HotelRule)
    {
        $request->validate(HotelRule::$validateRule);
        $this->hotelRuleObject->updateHotelRule($request, $HotelRule);
        return back();
    }
}
