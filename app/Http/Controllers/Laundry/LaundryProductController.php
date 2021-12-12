<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryProduct;
use Illuminate\Http\Request;

class LaundryProductController extends Controller
{
    protected $laundryProductObject;

    public function __construct()
    {
        $this->laundryProductObject = new LaundryProduct();
    }

    public function index()
    {
        $products = LaundryProduct::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.laundry.product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate(LaundryProduct::$validateRule);
        $this->laundryProductObject->storeLaundryProduct($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(LaundryProduct::$validateRule);
        $this->laundryProductObject->updateLaundryProduct($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->laundryProductObject->destroyLaundryProduct($id);
        return back();
    }
}
