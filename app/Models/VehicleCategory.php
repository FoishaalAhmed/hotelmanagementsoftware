<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255'],
    ];

    public function storeVehicleCategory(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeVehicleCategory = $this->save();

        $storeVehicleCategory
            ? session()->flash('message', 'New Vehicle Category Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateVehicleCategory(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->hotel_id = auth()->user()->hotel_id;
        $category->name = $request->name;
        $updateVehicleCategory = $category->save();

        $updateVehicleCategory
            ? session()->flash('message', 'Vehicle Category Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyVehicleCategory(Int $id)
    {
        $category = $this::findOrFail($id);
        $destroyVehicleCategory = $category->delete();

        $destroyVehicleCategory
            ? session()->flash('message', 'Vehicle Category Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
