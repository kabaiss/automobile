<?php

namespace App\Application\Requests\Admin\Maincar;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestMaincar extends FormRequest
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
            "title.*" => "min:4|max:120|required",
			"image" => "required|image",
			
        ];
    }
}
