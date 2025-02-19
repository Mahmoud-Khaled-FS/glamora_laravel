<?php

namespace Src\Features\Auth\Controllers;

use Illuminate\Http\Request;
use Src\Features\Auth\Requests\RegisterRequest;
use Src\Features\Auth\Services\AuthService;
use Src\Shared\Error\AppError;
use Src\Shared\Response\AppResponse;

class AuthController
{
    public function __construct(private readonly AuthService $authService) {}

    public function login(Request $request)
    {
        return $this->authService->login();
    }

    public function register(RegisterRequest $request)
    {
        // throw new AppError("error", 400, "ERR_REGISTER");
        return AppResponse::created($this->authService->register($request->validated()));
    }
}
