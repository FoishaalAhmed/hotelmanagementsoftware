<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    protected $hallObject;

    public function __construct()
    {
        $this->hallObject = new Hall();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $halls = $this->hallObject->getHalls();
            return response()->json($halls, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(Hall::$validateRule);
            $this->hallObject->storeHall($request);
            $response = ['message' => 'New Hall Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(Hall $hall)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            return response()->json($hall, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, Hall $hall)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(Hall::$validateRule);
            $this->hallObject->updateHall($request, $hall);
            $response = ['message' => 'New Hall Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(Hall $hall)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $this->hallObject->destroyHall($hall);
            $response = ['message' => 'New Hall Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
