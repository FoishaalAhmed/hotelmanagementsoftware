<?php

namespace App\Http\Controllers\Api\Tour;

use App\Http\Controllers\Controller;
use App\Models\GuideCharge;
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
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $charges = $this->guideChargeObject->getGuideCharges();
            return response($charges, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $request->validate(GuideCharge::$validateRule);
            $this->guideChargeObject->storeGuideCharge($request);
            $response = ['message' => 'Guide Charge Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(GuideCharge $charge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            return response($charge, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, GuideCharge $charge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $request->validate(GuideCharge::$validateRule);
            $this->guideChargeObject->updateGuideCharge($request, $charge);
            $response = ['message' => 'Guide Charge Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(GuideCharge $charge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->guideChargeObject->destroyGuideCharge($charge);
            $response = ['message' => 'Guide Charge Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
