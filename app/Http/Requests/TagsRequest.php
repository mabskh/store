<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'name' => 'required',
           'slug' => 'required|unique:tags,slug,'.$this->id
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
