<?php

namespace Src\Features\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Shared\Validation\ConstantValidation;

// TODO (MAHMOUD) - Add stopOnFirstFailure = true
// NOTE (MAHMOUD) - Need to modify the request behavior
// TODO (MAHMOUD) - Check what is better create global Validation class or Global Request Class
class RegisterRequest extends FormRequest
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
