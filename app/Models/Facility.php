<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Facility extends Model
{
    protected $fillable = [
        'name',
    ];

    public function storeFacility(Object $request)
    {
        $this->name    = $request->name;
        $storeFacility = $this->save();

        $storeFacility 
        ? Session::flash('message', 'Facility Created Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }

    public function updateFacility(Object $request, Int $id)
    {
        $facility       = $this::findOrFail($id);
        $facility->name = $request->name;
        $updateFacility = $facility->save();

        $updateFacility 
        ? Session::flash('message', 'Facility Updated Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }

    public function destroyFacility(Int $id)
    {
        $facility       = $this::findOrFail($id);
        $destroyFacility = $facility->delete();

        $destroyFacility 
        ? Session::flash('message', 'Facility Deleted Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }


}
