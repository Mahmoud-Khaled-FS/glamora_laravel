<?php

namespace Src\Features\User\Services;

use Src\Features\User\Models\User;

class UserService
{
  public function createOne(array $data): User
  {
    // TODO (MAHMOUD) - Create DTO class!
    return User::create($data);
  }
}
