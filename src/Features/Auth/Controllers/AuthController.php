<?php

namespace Src\Features\Auth\Controllers;

use Src\Features\Auth\Requests\LoginRequest;
use Src\Features\Auth\Requests\RegisterRequest;
use Src\Features\Auth\Services\AuthService;
use Src\Shared\Response\AppResponse;

class AuthController
{
    public function __construct(private readonly AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        return AppResponse::ok($this->authService->login($request->bodyMapped()));
    }

    public function register(RegisterRequest $request)
    {
        return AppResponse::created($this->authService->register($request->bodyMapped()));
    }
}
