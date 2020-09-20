<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'parent_id' => 'required|exists:categories,id',
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
