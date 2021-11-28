<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'hall_id' => ['required', 'numeric', 'min: 1'],
            'type' => ['string', 'required', 'max: 255'],
            'room_id' => ['required_if: type,==,In House', 'numeric', 'min: 1', 'nullable'],
            'name' => ['required_if: type,==,Outside', 'string', 'max: 255', 'nullable'],
            'phone' => ['required_if: type,==,Outside', 'string', 'max: 15', 'nullable'],
            'email' => ['required_if: type,==,Outside', 'string', 'email', 'max: 255', 'nullable'],
            'address' => ['required_if: type,==,Outside', 'string', 'nullable'],
            'booking_type' => ['required', 'string', 'max: 255'],
            'start_time' => ['required_if: booking_type,==,Hourly', 'date_format:H:i A'],
            'end_time' => ['required_if: booking_type,==,Hourly', 'nullable'],
            'start_date' => ['required_if: booking_type,==,Daily', 'date'],
            'end_date' => ['required_if: booking_type,==,Hourly', 'date', 'after: start_date'],
            'rent' => ['required', 'numeric', 'min: 1'],
            'payment_method' => ['required', 'string', 'max: 10'],
            'paid' => ['required', 'numeric', 'min: 1'],
        ];
    }
}
