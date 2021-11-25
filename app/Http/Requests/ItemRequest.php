<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'food_category_id' => 'required|numeric|min: 1',
            'food_type_id'     => 'required|numeric|min: 1',
            'name'             => 'required|string|max : 255',
            'description'      => 'required|string',
            'price'            => 'required|numeric',
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                "photo" => "required|mimes:jpeg,jpg,png,gif,webp|max:1999",
            ];
        } else {
            return $rules + [
                "photo" => "nullable|mimes:jpeg,jpg,png,gif,webp|max:1999",
            ];
        }
    }
}
