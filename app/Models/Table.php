<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'hotel_id', 'number', 'capacity',
    ];

    public static $validateRule = [
        'number' => ['required', 'string', 'max:50'],
        'capacity' => ['required', 'string', 'max:50'],
    ];

    public function storeTable(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->number = $request->number;
        $this->capacity = $request->capacity;
        $storeTable = $this->save();

        $storeTable
            ? session()->flash('message', 'New Table Number Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateTable(Object $request, Int $id)
    {
        $table = $this::findOrFail($id);
        $table->hotel_id = auth()->user()->hotel_id;
        $table->number = $request->number;
        $table->capacity = $request->capacity;
        $updateTable = $table->save();

        $updateTable
            ? session()->flash('message', 'Table Number Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyTable(Int $id)
    {
        $table = $this::findOrFail($id);
        $destroyTable = $table->delete();

        $destroyTable
            ? session()->flash('message', 'Table Number Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
