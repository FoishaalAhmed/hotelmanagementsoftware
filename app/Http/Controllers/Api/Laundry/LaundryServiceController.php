<?php

namespace App\Http\Controllers\Api\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use App\Models\LaundryServiceDetail;
use App\Models\Room;
use Illuminate\Http\Request;

class LaundryServiceController extends Controller
{
    protected $laundryServiceObject;

    public function __construct()
    {
        $this->laundryServiceObject = new LaundryService();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $services = $this->laundryServiceObject->getLaundryServices();
            return response()->json($services, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $this->laundryServiceObject->storeLaundryService($request);
            $response = ['message' => 'New Laundry Service Request Stored!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(LaundryService $laundryService)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $laundryServiceDetailObject = new LaundryServiceDetail();
            $details = $laundryServiceDetailObject->getLaundryServiceDetail($laundryService->id);
            $room = Room::where('id', $laundryService->room_id)->firstOrFail();
            $response = ['details' => $details, 'room' => $room, 'laundryService' => $laundryService];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(LaundryService $laundryService)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $this->laundryServiceObject->destroyLaundryService($laundryService);
            $response = ['message' => 'Laundry Service Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
