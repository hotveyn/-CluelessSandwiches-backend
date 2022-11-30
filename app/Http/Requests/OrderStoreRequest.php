<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            "products" => [
                [
                    "product_id" => "required|integer|min:1",
                    "product_count" => "required|integer|min:1",
                    "options" => [
                        [
                            "name" => "required|string",
                            "toggle" => "required|boolean"
                        ]
                    ]
                ]
            ]
        ];
    }
}
