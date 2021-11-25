<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultipleBookingRequest extends FormRequest
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

            'client'       => ['required', 'string', 'max : 255'],
            'email'      => ['nullable', 'string', 'max : 255'],
            'nid_number' => ['required', 'string', 'max : 50'],
            'phone'      => ['required', 'string', 'max : 15'],
            'adult'      => ['required', 'numeric', 'min: 1'],
            'children'   => ['required', 'numeric', 'max: 5'],
            'address'    => ['nullable', 'string'],
            'photo'      => ['nullable', 'max: 200'],
            'check_in'   => ['required', 'date'],
            'check_out'  => ['required', 'date'],
            'rent'       => ['required', 'numeric', 'min: 0'],
            'vat'        => ['nullable', 'numeric', 'min: 1'],
            'vat_amount' => ['nullable', 'numeric', 'min: 1'],
            'subtotal'   => ['required', 'numeric', 'min: 1'],
            'discount'   => ['nullable', 'numeric', 'min: 1'],
            'total'      => ['required', 'numeric', 'min: 1'],
            'room_id.*'    => ['nullable', 'numeric', 'min:1'],
            'person.*'    => ['nullable', 'string', 'max:255'],
            'name.*'    => ['nullable', 'string', 'max:255'],
        ];
    }
}
