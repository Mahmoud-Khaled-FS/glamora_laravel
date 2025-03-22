<?php

namespace Src\Shared\Utils;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelpers
{
  public static function getMetadata(LengthAwarePaginator $data): array
  {
    return [
      'from' => $data->firstItem() ?? 0,
      'to' => $data->lastItem() ?? 0,
      'total' => $data->total(),
      'lastPage' => $data->lastPage(),
      'perPage' => $data->perPage(),
    ];
  }
}
