<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallRent extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'hall_id', 'type', 'rent',
    ];

    public static $validateRule = [
        'hall_id' => ['required', 'numeric', 'min: 1'],
        'type' => ['required', 'string', 'max: 6'],
        'rent' => ['required', 'numeric', 'min: 1'],
    ];

    public function getHallRents()
    {
        $rents = $this::join('halls', 'hall_rents.hall_id', '=', 'halls.id')
            ->where('hall_rents.hotel_id', auth()->user()->hotel_id)
            ->orderBy('halls.name', 'asc')
            ->select('hall_rents.*', 'halls.name')
            ->get();
        return $rents;
    }

    public function storeHallRents(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->hall_id = $request->hall_id;
        $this->type = $request->type;
        $this->rent = $request->rent;
        $storeHallRents = $this->save();

        $storeHallRents
            ? session()->flash('message', 'Hall Rent Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateHallRents(Object $request, Object $rent)
    {
        $rent->hotel_id = auth()->user()->hotel_id;
        $rent->hall_id = $request->hall_id;
        $rent->type = $request->type;
        $rent->rent = $request->rent;
        $updateHallRents = $rent->save();

        $updateHallRents
            ? session()->flash('message', 'Hall Rent Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHallRents(Object $rent)
    {
        $destroyHallRents = $rent->delete();

        $destroyHallRents
            ? session()->flash('message', 'Hall Rent Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
