<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'percent',
    ];

    public static $validateRule = [
        'name' => ['string', 'required', 'max:255'],
        'percent' => ['numeric', 'required'],
    ];

    public function storePackage(Object $request)
    {
        $this->name    = $request->name;
        $this->percent = $request->percent;
        $storePackage  = $this->save();

        $storePackage
            ? session()->flash('message', 'New Package Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updatePackage(Object $request, Int $id)
    {
        $package = $this::findOrFail($id);
        $package->name    = $request->name;
        $package->percent = $request->percent;
        $updatePackage    = $package->save();

        $updatePackage
            ? session()->flash('message', 'Package Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyPackage(Int $id)
    {
        $package = $this::findOrFail($id);
        $destroyPackage    = $package->delete();

        $destroyPackage
            ? session()->flash('message', 'Package Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
