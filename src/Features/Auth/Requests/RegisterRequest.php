<?php

namespace Src\Features\Auth\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class RegisterRequest extends AppJsonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone" => ConstantValidation::phoneRules(),
            "name" => ["required", "string", "min:2", "max:255"],
            "password" => ConstantValidation::passwordRules(),
        ];
    }
}
