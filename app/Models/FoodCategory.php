<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $fillable = [
        'name', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max:255'],
    ];

    public function storeFoodCategory(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeFoodCategory = $this->save();

        $storeFoodCategory
            ? session()->flash('message', 'New Food Category Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateFoodCategory(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->hotel_id = auth()->user()->hotel_id;
        $category->name = $request->name;
        $updateFoodCategory = $category->save();

        $updateFoodCategory
            ? session()->flash('message', 'Food Category Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyFoodCategory(Int $id)
    {
        $category = $this::findOrFail($id);
        $destroyFoodCategory = $category->delete();

        $destroyFoodCategory
            ? session()->flash('message', 'Food Category Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
