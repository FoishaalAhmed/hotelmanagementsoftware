<?php

namespace App\Http\Controllers\Api\Gym;

use App\Http\Controllers\Controller;
use App\Models\GymUser;
use Illuminate\Http\Request;

class GymUserController extends Controller
{
    protected $gymUserObject;

    public function __construct()
    {
        $this->gymUserObject = new GymUser();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $users = $this->gymUserObject->getGymUsers();
            return response()->json($users, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $request->validate(GymUser::$validateRule);
            $this->gymUserObject->storeGymUser($request);
            $response = ['message' => 'Gym User Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(GymUser $gymUser)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $this->gymUserObject->destroyGymUser($gymUser);
            $response = ['message' => 'Gym User Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
