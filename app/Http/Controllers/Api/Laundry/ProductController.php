<?php

namespace App\Http\Controllers\Api\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $laundryProductObject;

    public function __construct()
    {
        $this->laundryProductObject = new LaundryProduct();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $products = LaundryProduct::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
            return response()->json($products, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $request->validate(LaundryProduct::$validateRule);
            $this->laundryProductObject->storeLaundryProduct($request);
            $response = ['message' => 'New Product Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $product = LaundryProduct::findOrFail($id);
            return response()->json($product, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $request->validate(LaundryProduct::$validateRule);
            $this->laundryProductObject->updateLaundryProduct($request, $id);
            $response = ['message' => 'Product Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $this->laundryProductObject->destroyLaundryProduct($id);
            $response = ['message' => 'Product Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
