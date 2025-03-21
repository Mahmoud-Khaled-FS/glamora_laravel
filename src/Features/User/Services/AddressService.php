<?php

namespace Src\Features\User\Services;

use Illuminate\Support\Collection;
use Src\Features\User\Models\Address;
use Src\Features\User\Models\User;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class AddressService
{
  public function __construct() {}

  public function getUserAddresses(User $user): Collection
  {
    return $user->addresses;
  }

  public function createOne(User $user, array $data): Address
  {
    $addressCount = $user->addresses()->count();
    if ($addressCount >= 5) {
      throw new AppError('You have reached the maximum number of addresses', 400, ErrorCode::ERR_REQUIREMENT_ERROR);
    }
    return $user->addresses()->create($data);
  }

  public function updateOne(int $id, array $data): Address
  {
    $address = Address::find($id);
    if (!$address) {
      throw new AppError('Address not found', 404, ErrorCode::ERR_NOT_FOUND);
    }
    $address->update($data);
    return $address;
  }

  public function deleteOne(Address|int $address): void
  {
    Address::destroy($address);
  }
}
