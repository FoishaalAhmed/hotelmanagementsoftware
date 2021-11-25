<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodType;
use App\Models\TodayMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $todayMenuObject;

    public function __construct()
    {
        $this->todayMenuObject = new TodayMenu();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
            return response($types, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(TodayMenu::$validateStoreRule);
            $this->todayMenuObject->storeTodayMenu($request);
            $response = ['message' => 'Today Menu Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $items = $this->todayMenuObject->getTodayMenusByFoodType($id);
            return response($items, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(TodayMenu::$validateUpdateRule);
            $this->todayMenuObject->updateTodayMenu($request, $id);
            $response = ['message' => 'Today Menu Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $this->todayMenuObject->destroyTodayMenu($id);
            $response = ['message' => 'Today Menu Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
