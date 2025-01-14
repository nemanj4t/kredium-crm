<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CashLoanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required'],
        ];
    }
}
