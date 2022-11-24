<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            "toggle" => "required|integer|min:0|max:1"
        ];
    }
}
