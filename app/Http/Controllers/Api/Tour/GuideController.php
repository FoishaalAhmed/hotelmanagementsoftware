<?php

namespace App\Http\Controllers\Api\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuideRequest;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    protected $guideObject;

    public function __construct()
    {
        $this->guideObject = new Guide();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
            return response($guides, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(GuideRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->guideObject->storeGuide($request);
            $response = ['message' => 'Guide Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(Guide $guide)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            return response($guide, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, Guide $guide)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->guideObject->updateGuide($request, $guide);
            $response = ['message' => 'Guide Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(Guide $guide)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->guideObject->destroyGuide($guide);
            $response = ['message' => 'Guide Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
