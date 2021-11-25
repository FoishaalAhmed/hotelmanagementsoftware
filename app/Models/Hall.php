<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'hall_category_id', 'name', 'capacity', 'board', 'stage', 'projector', 'ac', 'fan', 'sound_system',
    ];

    public static $validateRule = [
        'hall_category_id' => ['numeric', 'required', 'min: 1'],
        'name' => ['string', 'required', 'max: 255'],
        'capacity' => ['numeric', 'required', 'min: 1'],
        'board' => ['numeric', 'required', 'between: 0,1'],
        'stage' => ['numeric', 'required', 'between: 0,1'],
        'projector' => ['numeric', 'required', 'between: 0,1'],
        'ac' => ['numeric', 'required', 'between: 0,1'],
        'fan' => ['numeric', 'required', 'between: 0,1'],
        'sound_system' => ['numeric', 'required', 'between: 0,1'],
    ];

    public function getHalls()
    {
        $halls = $this::join('hall_categories', 'halls.hall_category_id', '=', 'hall_categories.id')
            ->where('halls.hotel_id', auth()->user()->hotel_id)
            ->orderBy('halls.name', 'asc')
            ->select('halls.*', 'hall_categories.name as category')
            ->get();
        return $halls;
    }

    public function storeHall(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->hall_category_id = $request->hall_category_id;
        $this->name = $request->name;
        $this->capacity = $request->capacity;
        $this->board = $request->board;
        $this->stage = $request->stage;
        $this->projector = $request->projector;
        $this->ac = $request->ac;
        $this->fan = $request->fan;
        $this->sound_system = $request->sound_system;
        $storeHall = $this->save();

        $storeHall
            ? session()->flash('message', 'New Hall Info Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateHall(Object $request, Object $hall)
    {
        $hall->hotel_id = auth()->user()->hotel_id;
        $hall->hall_category_id = $request->hall_category_id;
        $hall->name = $request->name;
        $hall->capacity = $request->capacity;
        $hall->board = $request->board;
        $hall->stage = $request->stage;
        $hall->projector = $request->projector;
        $hall->ac = $request->ac;
        $hall->fan = $request->fan;
        $hall->sound_system = $request->sound_system;
        $updateHall = $hall->save();

        $updateHall
            ? session()->flash('message', 'Hall Info Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHall(Object $hall)
    {
        $destroyHall = $hall->delete();

        $destroyHall
            ? session()->flash('message', 'Hall Info Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
