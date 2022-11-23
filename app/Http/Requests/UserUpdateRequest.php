<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string password
 * @property string name
 * @property string email
 */
class UserUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "password" => "string|min:4",
            "name" => "string|min:4",
            "email" => "string|min:2"
        ];
    }
}
