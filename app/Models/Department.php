<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => 'required|string|max:255',
    ];

    public function storeDepartment($request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeDepartment = $this->save();

        $storeDepartment
            ? session()->flash('message', 'Department Created Successfully!')
            : session()->flash('message', 'Department Create Failed!');
    }
    public function updateDepartment($request, $id)
    {
        $department = $this::findOrFail($id);
        $department->hotel_id = auth()->user()->hotel_id;
        $department->name = $request->name;
        $updateDepartment = $department->save();

        $updateDepartment
            ? session()->flash('message', 'Department Updated Successfully!')
            : session()->flash('message', 'Department Update Failed!');
    }

    public function deleteDepartment($id)
    {
        $department = $this::findOrFail($id);
        $deleteDepartment = $department->delete();
        $deleteDepartment
            ? session()->flash('message', 'Department Deleted Successfully!')
            : session()->flash('message', 'Department Delete Failed!');
    }
}
