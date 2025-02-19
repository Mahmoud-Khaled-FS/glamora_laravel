<?php

namespace Src\Features\Auth\Services;

use Src\Features\User\Services\UserService;

class AuthService
{
  public function __construct(private readonly UserService $userService) {}
  public function login()
  {
    return [
      'token' => 'token',
      'user' => 'user'
    ];
  }

  public function register(array $data)
  {
    return $this->userService->createOne($data);
  }
}
