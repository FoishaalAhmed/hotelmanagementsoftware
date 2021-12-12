<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255', 'unique:laundry_products,name']
    ];

    public function storeLaundryProduct(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeLaundryProduct = $this->save();

        $storeLaundryProduct
            ? session()->flash('message', 'Product Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateLaundryProduct(Object $request, Int $id)
    {
        $product = $this::findOrFail($id);
        $product->hotel_id = auth()->user()->hotel_id;
        $product->name = $request->name;
        $updateLaundryProduct = $product->save();

        $updateLaundryProduct
            ? session()->flash('message', 'Product updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyLaundryProduct(Int $id)
    {
        $product = $this::findOrFail($id);
        $destroyLaundryProduct = $product->delete();

        $destroyLaundryProduct
            ? session()->flash('message', 'Product Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
