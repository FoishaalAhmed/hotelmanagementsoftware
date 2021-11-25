<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'minimum_stay', 'security', 'on_site_staff', 'house_keeping', 'house_keeping_frequency', 'front_desk', 'extra_people', 'security_deposite', 'cancellation',
    ];

    public static $validateRule = [
        'minimum_stay'            => ['required', 'string', 'max: 255'],
        'security'                => ['required', 'string', 'max: 255'],
        'on_site_staff'           => ['required', 'string', 'max: 255'],
        'house_keeping'           => ['required', 'string', 'max: 255'],
        'house_keeping_frequency' => ['required', 'string', 'max: 255'],
        'front_desk'              => ['required', 'string', 'max: 255'],
        'extra_people'            => ['required', 'string', 'max: 255'],
        'security_deposite'       => ['required', 'string', 'max: 255'],
        'cancellation'            => ['required', 'string', 'max: 255']
    ];

    public function updateHotelRule(Object $request, Object $rule)
    {
        $rule->minimum_stay = $request->minimum_stay;
        $rule->security = $request->security;
        $rule->on_site_staff = $request->on_site_staff;
        $rule->house_keeping = $request->house_keeping;
        $rule->house_keeping_frequency = $request->house_keeping_frequency;
        $rule->front_desk = $request->front_desk;
        $rule->extra_people = $request->extra_people;
        $rule->security_deposite = $request->security_deposite;
        $rule->cancellation = $request->cancellation;
        $updateHotelRule = $rule->save();

        $updateHotelRule
            ? session()->flash('message', 'Hotel Rule Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
