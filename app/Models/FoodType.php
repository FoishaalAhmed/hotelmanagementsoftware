<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $fillable = [
        'name', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max:255'],
    ];

    public function storeFoodType(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeFoodType = $this->save();

        $storeFoodType
            ? session()->flash('message', 'New Food Type Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateFoodType(Object $request, Int $id)
    {
        $type = $this::findOrFail($id);
        $type->name = $request->name;
        $type->hotel_id = auth()->user()->hotel_id;
        $updateFoodType = $type->save();

        $updateFoodType
            ? session()->flash('message', 'Food Type Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyFoodType(Int $id)
    {
        $type = $this::findOrFail($id);
        $destroyFoodType = $type->delete();

        $destroyFoodType
            ? session()->flash('message', 'Food Type Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
