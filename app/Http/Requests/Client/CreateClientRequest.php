<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Client\DTO\CreateClientParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CreateClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                Rule::unique('clients', 'email')->ignore($this->route('client')),
                'email',
                'max:255'
            ],
            'phone' => ['nullable', 'string', 'max:15', 'min:10']
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->filled('email') && !$this->filled('phone')) {
                $validator->errors()->add(
                    'email',
                    'Either email or phone must be provided.'
                );

                $validator->errors()->add(
                    'phone',
                    'Either email or phone must be provided.'
                );
            }
        });
    }

    public function params(): CreateClientParams
    {
        $params = $this->validated();

        return new CreateClientParams(
            $params['first_name'],
            $params['last_name'],
            $params['email'] ?? null,
            $params['phone'] ?? null,
        );
    }
}
