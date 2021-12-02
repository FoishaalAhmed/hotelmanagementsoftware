<?php

namespace App\Http\Controllers\Api\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourUser;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tourObject;

    public function __construct()
    {
        $this->tourObject = new Tour();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $tours = $this->tourObject->getTours();
            return response($tours, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->tourObject->storeTour($request);
            $response = ['message' => 'Tour Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $tourUserObject = new TourUser();
            $tour = $this->tourObject->getTourById($id);
            $users = $tourUserObject->getTourUsers($id);
            $response = [
                'tour' => $tour,
                'users' => $users,
            ];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(Tour $tour)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Tour')) {
            $this->tourObject->destroyTour($tour);
            $response = ['message' => 'Tour Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
