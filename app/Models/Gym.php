<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'name', 'capacity', 'type', 'trainer', 'ac',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255'],
        'capacity' => ['required', 'numeric', 'min: 1'],
        'type' => ['required', 'string', 'max: 10'],
        'trainer' => ['required', 'numeric', 'between: 0, 1'],
        'ac' => ['required', 'numeric', 'between: 0, 1'],
    ];

    public function storeGym(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $this->capacity = $request->capacity;
        $this->type = $request->type;
        $this->trainer = $request->trainer;
        $this->ac = $request->ac;
        $storeGym = $this->save();

        $storeGym
            ? session()->flash('message', 'New Gym Info Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateGym(Object $request, Object $gym)
    {
        $gym->hotel_id = auth()->user()->hotel_id;
        $gym->name = $request->name;
        $gym->capacity = $request->capacity;
        $gym->type = $request->type;
        $gym->trainer = $request->trainer;
        $gym->ac = $request->ac;
        $updateGym = $gym->save();

        $updateGym
            ? session()->flash('message', 'Gym Info Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyGym(Object $gym)
    {
        $destroyGym = $gym->delete();

        $destroyGym
            ? session()->flash('message', 'Gym Info Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
