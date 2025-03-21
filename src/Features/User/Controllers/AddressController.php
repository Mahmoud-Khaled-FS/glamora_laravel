<?php

namespace Src\Features\User\Controllers;

use Auth;
use Src\Features\User\Models\Address;
use Src\Features\User\Requests\StoreAddressRequest;
use Src\Features\User\Services\AddressService;
use Src\Shared\Response\AppResponse;

class AddressController
{
  public function __construct(private readonly AddressService $addressService) {}

  public function getUserAddresses()
  {
    return AppResponse::ok($this->addressService->getUserAddresses(Auth::user()));
  }

  public function storeAddress(StoreAddressRequest $request)
  {
    $address = $this->addressService->createOne(Auth::user(), $request->bodyMapped());
    return AppResponse::ok($address);
  }

  public function updateAddress(int $id, StoreAddressRequest $request)
  {
    $address = $this->addressService->updateOne($id, $request->bodyMapped());
    return AppResponse::ok($address);
  }

  public function deleteAddress(int $id)
  {
    $this->addressService->deleteOne($id);
    return AppResponse::noContent();
  }
}
