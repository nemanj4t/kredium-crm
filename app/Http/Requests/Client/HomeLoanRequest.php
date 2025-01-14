<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'property_value' => ['required'],
            'down_payment_amount' => ['required'],
        ];
    }
}
