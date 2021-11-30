<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'guide_id', 'type', 'package_id', 'charge',
    ];

    public static $validateRule = [
        'guide_id' => ['required', 'numeric', 'min: 1'],
        'type' => ['required', 'string', 'max: 255'],
        'package_id' => ['required_if: type,==,Package', 'string', 'max: 255'],
        'charge' => ['required', 'numeric', 'min: 1'],
    ];

    public function storeGuideCharge(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->guide_id = $request->guide_id;
        $this->type = $request->type;
        $this->package_id = $request->package_id;
        $this->charge = $request->charge;
        $storeGuideCharge = $this->save();

        $storeGuideCharge
            ? session()->flash('message', 'New Guide Charge Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateGuideCharge(Object $request, Object $charge)
    {
        $charge->hotel_id = auth()->user()->hotel_id;
        $charge->guide_id = $request->guide_id;
        $charge->type = $request->type;
        $charge->package_id = $request->package_id;
        $charge->charge = $request->charge;
        $updateGuideCharge = $charge->save();

        $updateGuideCharge
            ? session()->flash('message', 'Guide Charge Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyGuideCharge(Object $charge)
    {
        $destroyGuideCharge = $charge->delete();

        $destroyGuideCharge
            ? session()->flash('message', 'Guide Charge Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
