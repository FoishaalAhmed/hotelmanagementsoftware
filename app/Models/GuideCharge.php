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
        'package_id' => ['required_if:type,==,Package', 'numeric', 'max: 255', 'nullable'],
        'charge' => ['required', 'numeric', 'min: 1'],
    ];

    public function getGuideCharges()
    {
        $charges = $this::join('guides', 'guide_charges.guide_id', '=', 'guides.id')
            ->leftJoin('tour_packages', 'guide_charges.tour_package_id', '=', 'tour_packages.id')
            ->orderBy('guides.name', 'asc')
            ->where('guide_charges.hotel_id', auth()->user()->hotel_id)
            ->select('guide_charges.*', 'guides.name', 'tour_packages.name as package')
            ->get();
        return $charges;
    }

    public function storeGuideCharge(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->guide_id = $request->guide_id;
        $this->type = $request->type;
        $this->tour_package_id = $request->package_id;
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
        $charge->tour_package_id = $request->type == 'Package' ? $request->package_id : null ;
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
