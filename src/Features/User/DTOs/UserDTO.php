<?php

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserDTO extends Data
{
  public string $name;
  public string $phone;
  public string|Optional $password;
}
