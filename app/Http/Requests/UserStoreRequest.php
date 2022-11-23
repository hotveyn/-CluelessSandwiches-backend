<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string phone
 * @property string password
 */
class UserStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|string|max:32|min:6',
            'password' => 'required|string|min:8|max:35'
        ];
    }
}
