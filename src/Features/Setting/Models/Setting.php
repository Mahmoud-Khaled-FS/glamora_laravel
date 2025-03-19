<?php

namespace Src\Features\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Setting\Enum\SettingKeys;

class Setting extends Model
{
  protected $casts = [
    'key' => SettingKeys::class
  ];
}
