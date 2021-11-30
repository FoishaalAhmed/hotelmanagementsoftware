<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'name',
    ];

    public static $validateRule = [
        'name' => ['string', 'required', 'max: 255',],
    ];

    public function storeTourPackage(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $this->duration = $request->duration;
        $storeTourPackage = $this->save();

        $storeTourPackage
            ? session()->flash('message', 'New Tour Package Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateTourPackage(Object $request, Int $id)
    {
        $package = $this::findOrFail($id);

        $package->hotel_id = auth()->user()->hotel_id;
        if($request->name != $package->name) $package->name = $request->name;
        $package->duration = $request->duration;
        $updateTourPackage = $package->save();

        $updateTourPackage
            ? session()->flash('message', 'Tour Package Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyTourPackage(Int $id)
    {
        $package = $this::findOrFail($id);
        $destroyTourPackage = $package->delete();

        $destroyTourPackage
            ? session()->flash('message', 'Tour Package Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
