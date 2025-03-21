<?php

namespace Src\Features\User\Services;

use Src\Features\User\Models\User;
use Storage;

class UserService
{
  public function createOne(array $data): User
  {
    // TODO (MAHMOUD) - Create DTO class!
    return User::create($data);
  }

  public function getByPhone(string $email): ?User
  {
    return User::where('phone', $email)->first();
  }

  public function updateUser(User $user, array $data): User
  {
    $user->update($data);
    return $user;
  }

  public function getUserById(int $id): ?User
  {
    return User::find($id);
  }

  public function deleteUser(User|int $user): void
  {
    User::destroy($user);
  }

  // TODO (MAHMOUD) - Create User DTO!
  public function toUserResponse(User $user): array
  {
    dd(asset(Storage::url($user->avatar)));
    return [
      'id' => $user->id,
      'firstName' => $user->first_name,
      'lastName' => $user->last_name,
      'email' => $user->email,
      'phone' => $user->phone,
      'avatar' => Storage::url($user->avatar),
      'dateOfBirth' => $user->dateOfBirth,
    ];
  }
}
