<?php

namespace App\Http\Controllers\Api\Tour;

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
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
            return response($packages, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $request->validate(TourPackage::$validateRule);
            $this->tourPackageObject->storeTourPackage($request);
            $response = ['message' => 'Tour Package Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $package = TourPackage::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->first();
            return response($package, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $request->validate(TourPackage::$validateRule);
            $this->tourPackageObject->updateTourPackage($request, $id);
            $response = ['message' => 'Tour Package Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->tourPackageObject->storeTourPackage($id);
            $response = ['message' => 'Tour Package Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
