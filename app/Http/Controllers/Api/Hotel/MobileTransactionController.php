<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\MobileTransaction;
use Illuminate\Http\Request;

class MobileTransactionController extends Controller
{
    private $mobileTransactionObject;

    public function __construct()
    {
        $this->mobileTransactionObject = new MobileTransaction();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $transactions = $this->mobileTransactionObject->getHotelMobileTransactions();
            return response()->json($transactions, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(MobileTransaction::$validateRule);
            $this->mobileTransactionObject->storeMobileTransaction($request);
            $response = ['message' => 'New Mobile Transaction Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(MobileTransaction $mobileTransaction)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            return response()->json($mobileTransaction, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, MobileTransaction $mobileTransaction)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(MobileTransaction::$validateRule);
            $this->mobileTransactionObject->updateMobileTransaction($request, $mobileTransaction);
            $response = ['message' => 'Mobile Transaction Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(MobileTransaction $mobileTransaction)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->mobileTransactionObject->destroyMobileTransaction($mobileTransaction);
            $response = ['message' => 'Mobile Transaction Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
