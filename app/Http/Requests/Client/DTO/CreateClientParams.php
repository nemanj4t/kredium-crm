<?php

namespace App\Http\Requests\Client\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

readonly class CreateClientParams
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
    ) {
    }
}
