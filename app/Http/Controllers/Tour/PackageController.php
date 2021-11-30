<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $tourPackageObject;

    public function __construct()
    {
        $this->tourPackageObject = new TourPackage();
    }

    public function index()
    {
        $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.tour.package', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate(TourPackage::$validateRule);
        $this->tourPackageObject->storeTourPackage($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(TourPackage::$validateRule);
        $this->tourPackageObject->updateTourPackage($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->tourPackageObject->storeTourPackage($id);
        return back();
    }
}
