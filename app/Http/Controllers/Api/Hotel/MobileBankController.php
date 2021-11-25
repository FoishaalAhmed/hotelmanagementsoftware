<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\MobileBank;
use Illuminate\Http\Request;

class MobileBankController extends Controller
{
    private $mobileBankObject;

    public function __construct()
    {
        $this->mobileBankObject = new MobileBank();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $banks = MobileBank::where('hotel_id', auth()->user()->hotel_id)->get();
            return response()->json($banks, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(MobileBank::$validateRule);
            $this->mobileBankObject->storeMobileBank($request);
            $response = ['message' => 'New Mobile Bank Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $bank = MobileBank::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->first();
            return response()->json($bank, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(MobileBank::$validateRule);
            $this->mobileBankObject->updateMobileBank($request, $id);
            $response = ['message' => 'Mobile Bank Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->mobileBankObject->destroyMobileBank($id);
            $response = ['message' => 'Mobile Bank Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
