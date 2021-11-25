<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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

            'number'        => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'facing'        => 'required|string|max:255',
            'beds'          => 'required|string|max:255',
            'rate'          => 'required|numeric',
            "photo.*"       => "nullable|mimes:jpeg,jpg,png,gif,webp|max:1999",
            "video.*"       => "nullable|string|max:255",
        ];

        if ($this->getMethod() == 'POST') {

            return $rules + [

                "display_photo" => "required|mimes:jpeg,jpg,png,gif,webp|max:1999",
            ];
        } else {

            return $rules + [

                "display_photo" => "nullable|mimes:jpeg,jpg,png,gif,webp|max:1999",
            ];
        }
    }
}
