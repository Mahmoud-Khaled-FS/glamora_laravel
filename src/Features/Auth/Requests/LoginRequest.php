<?php

namespace Src\Features\Auth\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class LoginRequest extends AppJsonRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone" => ConstantValidation::phoneRules(),
            "password" => ConstantValidation::passwordRules(),
        ];
    }
}
