<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{

    protected $userObject;

    public function __construct()
    {
        $this->userObject = new User();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $users = User::where('hotel_id', auth()->user()->hotel_id)->get();
            return response($users, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(UserRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $user_id = $this->userObject->storeUser($request);
            $user = User::findOrFail($user_id);
            $token = $user->createToken('myAppToken')->plainTextToken;
    
            $response = [
                'user_id' => $user->id,
                'token' => $token
            ];
        
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $user = User::with(['roles', 'permissions'])->findOrFail($id);
            //$userPermissions = DB::table('model_has_permissions')->where('model_id', $id)->pluck('permission_id')->toArray();
            
            $response = [
                'user' => $user,
                //'userPermissions' => $userPermissions,
                ];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(UserRequest $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->userObject->updateUser($request, $id);
            $response = ['message' => 'User Updated Successfully!'];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
        
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->userObject->destroyUser($id);
            $response = ['message' => 'User Deleted Successfully!'];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
