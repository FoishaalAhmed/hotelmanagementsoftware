<?php

namespace App\Http\Controllers\Api\Gym;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    protected $gymObject;

    public function __construct()
    {
        $this->gymObject = new Gym();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $gyms = Gym::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
            return response()->json($gyms, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $request->validate(Gym::$validateRule);
            $this->gymObject->storeGym($request);
            $response = ['message' => 'New Gym Info Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(Gym $gym)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            return response()->json($gym, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, Gym $gym)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $request->validate(Gym::$validateRule);
            $this->gymObject->updateGym($request, $gym);
            $response = ['message' => 'Gym Info Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(Gym $gym)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $this->gymObject->destroyGym($gym);
            $response = ['message' => 'Gym Info Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
