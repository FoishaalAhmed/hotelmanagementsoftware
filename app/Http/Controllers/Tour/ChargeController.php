<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\GuideCharge;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    protected $guideChargeObject;

    public function __construct()
    {
        $this->guideChargeObject = new GuideCharge();
    }

    public function index()
    {
        $charges = $this->guideChargeObject->getGuideCharges();
        return view('backend.tour.charges.index', compact('charges'));
    }

    public function create()
    {
        $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.tour.charges.create', compact('guides', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate(GuideCharge::$validateRule);
        $this->guideChargeObject->storeGuideCharge($request);
        return back();
    }

    public function edit(GuideCharge $charge)
    {
        $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.tour.charges.edit', compact('guides', 'packages', 'charge'));
    }

    public function update(Request $request, GuideCharge $charge)
    {
        $request->validate(GuideCharge::$validateRule);
        $this->guideChargeObject->updateGuideCharge($request, $charge);
        return redirect()->route('tour.charges.index');
    }

    public function destroy(GuideCharge $charge)
    {
        $this->guideChargeObject->destroyGuideCharge($charge);
        return back();
    }
}
