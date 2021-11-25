<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name', 'start', 'end', 'hotel_id',
    ];

    public static $validateRule = [
        'name' => ['string', 'required', 'max:255'],
        'start' => ['required'],
        'end' => ['required'],
    ];

    public function storeShift(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $this->start = date('H:i', strtotime($request->start));
        $this->end = date('H:i', strtotime($request->end));
        $storeShift = $this->save();

        $storeShift
            ? session()->flash('message', 'New Shift Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateShift(Object $request, Int $id)
    {
        $shift = $this::findOrFail($id);
        $shift->hotel_id = auth()->user()->hotel_id;
        $shift->name = $request->name;
        $shift->start = date('H:i', strtotime($request->start));
        $shift->end = date('H:i', strtotime($request->end));
        $updateShift = $shift->save();

        $updateShift
            ? session()->flash('message', 'Shift Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyShift(Int $id)
    {
        $shift = $this::findOrFail($id);
        $destroyShift = $shift->delete();

        $destroyShift
            ? session()->flash('message', 'Shift Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
