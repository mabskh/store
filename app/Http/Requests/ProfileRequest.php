<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'name' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            // for Special Messages
        ];
    }
}


