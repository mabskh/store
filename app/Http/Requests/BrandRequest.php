<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'name' => 'required',
          'photo' => 'required_ without:id|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
