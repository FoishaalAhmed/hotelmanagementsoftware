<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255'],
    ];

    public function storeHallCategory(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeHallCategory = $this->save();

        $storeHallCategory
            ? session()->flash('message', 'New Hall Category Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateHallCategory(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->hotel_id = auth()->user()->hotel_id;
        $category->name = $request->name;
        $updateHallCategory = $category->save();

        $updateHallCategory
            ? session()->flash('message', 'Hall Category Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHallCategory(Int $id)
    {
        $category = $this::findOrFail($id);
        $destroyHallCategory = $category->delete();

        $destroyHallCategory
            ? session()->flash('message', 'Hall Category Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
