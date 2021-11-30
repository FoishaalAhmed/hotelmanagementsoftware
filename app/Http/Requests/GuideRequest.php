<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideRequest extends FormRequest
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
            'name' => ['required', 'string', 'max: 255'],
            'gender' => ['required', 'string', 'max: 10'],
            'age' => ['required', 'numeric', 'min: 18'],
            'phone' => ['required', 'string', 'max: 15'],
            'email' => ['nullable', 'string', 'max: 255'],
            'address' => ['required', 'string'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'photo'    => 'mimes:jpeg,jpg,png,gif,webp|max:100|required',
            ];
        } else {
            return $rules + [
                'photo'    => 'mimes:jpeg,jpg,png,gif,webp|max:100|nullable',
            ];
        }
    }
}
