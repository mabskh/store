<?php

namespace App\Http\Requests;

use App\Rules\UniqueAttributeName;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'name' => ['required' , 'max:100' , new UniqueAttributeName($this->name , $this->id)]
           // , 'name' => 'required|max:255|unique:attributes_translations,name' . $this->id
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
