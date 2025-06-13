<?php

namespace Src\Features\Auth\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class RegisterRequest extends AppJsonRequest
{
    protected $fields = [
        "firstName" => "first_name",
        "lastName" => "last_name",
        "dateOfBirth" => "date_of_birth",
    ];
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone" => ConstantValidation::phoneRules(),
            "password" => ConstantValidation::passwordRules(),
            "firstName" => ["required", "string", "min:2", "max:255"],
            "lastName" => ["required", "string", "min:2", "max:255"],
            "dateOfBirth" => ["required", "date"],
        ];
    }
}
