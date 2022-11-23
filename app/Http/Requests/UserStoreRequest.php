<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|string|max:32|min:6',
            "password" => 'required|string|min:8|max:35'
        ];
    }

}
