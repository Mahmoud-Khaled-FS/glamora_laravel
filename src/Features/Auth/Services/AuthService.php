<?php

namespace Src\Features\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Src\Features\User\Services\UserService;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class AuthService
{
  public function __construct(private readonly UserService $userService) {}

  public function login(array $data)
  {
    $user = $this->userService->getByPhone($data['phone']);
    if (!$user || !Hash::check($data['password'], $user->password)) {
      throw new AppError('Invalid credentials', 401, ErrorCode::ERR_UNAUTHORIZED);
    }
    return [
      'token' => $user->createToken($user->phone)->plainTextToken,
      'user' => $user
    ];
  }

  public function register(array $data)
  {
    return [
      'token' => $this->userService->createOne($data)->createToken($data['phone'])->plainTextToken,
      'user' => $this->userService->createOne($data)
    ];
  }
}
