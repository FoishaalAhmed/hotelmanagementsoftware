<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Service extends Model
{
    protected $fillable = [
        'name', 'charge_apply',
    ];

    public static $validateRule = [
        'name'         => ['string', 'required', 'max:255'],
        'charge_apply' => ['numeric', 'required']
    ];

    public function storeService(Object $request)
    {
        $this->name         = $request->name ;
        $this->charge_apply = $request->charge_apply ;
        $storeService       = $this->save();

        $storeService 
        ? Session::flash('message', 'Service Added Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }

    public function updateService(Object $request, Int $id)
    {
        $service = $this->findOrFail($id);

        $service->name         = $request->name ;
        $service->charge_apply = $request->charge_apply ;
        $updateService          = $service->save();

        $updateService 
        ? Session::flash('message', 'Service Updated Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }

    public function destroyService(Int $id)
    {
        $service        = $this->findOrFail($id);
        $destroyService = $service->save();

        $destroyService 
        ? Session::flash('message', 'Service Destroyed Successfully!') 
        : Session::flash('message', 'Something Went Wrong!') ;
    }
}
