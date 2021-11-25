<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingDetailRequest extends FormRequest
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
            'room_id.*' => ['numeric', 'required', 'min:1'],
            'person.*' => ['numeric', 'required', 'min:1'],
            'name.*' => ['string', 'required', 'max:255'],
            'check_in.*' => ['date', 'required'],
            'check_out.*' => ['date', 'required'],
        ];
    }
}
