<?php

namespace App\Http\Requests;
/**
 * @property string phone
 * @property string password
 */
class OrderStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            "status_id" => 'required|integer|min:1|max:5'
        ];
    }

}
