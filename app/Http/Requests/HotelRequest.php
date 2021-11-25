<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
        $rules = [

            'name'          => 'required|string|max:255',
            'map'           => 'nullable|string|max:255',
            'website'       => 'nullable|string|max:255',
            'road_house'    => 'nullable|string',
            'division_id'   => 'required|numeric',
            'district_id'   => 'required|numeric',
            'upozila_id'    => 'required|numeric',
            'zip_code'      => 'required|string|max:255',
            'floor'         => 'required|string|max:255',
            'trade_licence' => 'nullable|string|max:255',
            'tin_number'    => 'nullable|string|max:255',
            'about'         => 'nullable|string',
            'star'          => 'required|numeric|max:5|min:1',
            'fax'           => 'nullable|string|max:15',
            'logo'          => 'mimes:jpeg,jpg,png,gif,webp|max:10000|nullable',
            'email' => 'required|email|max:255|unique:hotels,email,' . $this->id,
            'phone' => 'nullable|string|max:15|unique:hotels,phone,' . $this->id,
        ];

        return $rules;
    }
}
