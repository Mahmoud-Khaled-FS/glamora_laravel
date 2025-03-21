<?php

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserDTO extends Data
{
  public string $firstName;
  public string $lastName;
  public string|Optional $phone;
}
