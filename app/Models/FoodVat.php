<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodVat extends Model
{
    protected $fillable = [
        'percent', 'hotel_id',
    ];

    public static $validateRule = [
        'percent' => ['required', 'numeric'],
    ];

    public function storeFoodVat(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->percent = $request->percent;
        $storeFoodVat = $this->save();

        $storeFoodVat
            ? session()->flash('message', 'New Food Vat Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateFoodVat(Object $request, Int $id)
    {
        $percent = $this::findOrFail($id);
        $percent->percent = $request->percent;
        $percent->hotel_id = auth()->user()->hotel_id;
        $updateFoodVat = $percent->save();

        $updateFoodVat
            ? session()->flash('message', 'Food Vat Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyFoodVat(Int $id)
    {
        $percent = $this::findOrFail($id);
        $destroyFoodVat = $percent->delete();

        $destroyFoodVat
            ? session()->flash('message', 'Food Vat Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
