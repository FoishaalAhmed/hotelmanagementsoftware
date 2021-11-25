<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'hotel_id',
    ];

    public static $validateRule = [
        'type' => ['required', 'string', 'max:255']
    ];

    public function storeRoomType(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->type = $request->type;
        $storeRoomType = $this->save();

        $storeRoomType
            ? session()->flash('message', 'New Room Type Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateRoomType(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->type = $request->type;
        $category->hotel_id = auth()->user()->hotel_id;
        $updateRoomType = $category->save();

        $updateRoomType
            ? session()->flash('message', 'Room Type Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyRoomType(Int $id)
    {
        $category = $this::findOrFail($id);
        $destroyRoomType = $category->delete();

        $destroyRoomType
            ? session()->flash('message', 'Room Type Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
