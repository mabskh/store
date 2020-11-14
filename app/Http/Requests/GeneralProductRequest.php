<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   /* public function rulest()
    {
        return [
           'name' => 'required',
           'type' => 'required|in:'.CategoryType::mainCategory,CategoryType::subCategory,
           'slug' => 'required|unique:categories,slug,'.$this->id,
            //'photo' => 'required_ without:id|mimes:jpg,jpeg,png'
        ];
    }*/


    public function rules()
    {
      $rules = [

            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,'.$this->id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'array|min:1',
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable',
            'brand_id' => 'required|exists:brands,id'
        ];

        return $rules;
    }


    public function messages()
    {
        return [

        ];
    }
}
