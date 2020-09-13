<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'name' => 'required',
           'slug' => 'required|unique:categories,slug,'.$this->id
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
