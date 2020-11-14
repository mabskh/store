<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
           // 'parent_id' => 'required|exists:categories,id',
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$this->id
        ];

        foreach(CategoryType::getAll() as $key => $val)
        {
            $rules[$key] = 'required|in:'.$val;
        }
        return $rules;
    }


    public function messages()
    {
        return [

        ];
    }
}
