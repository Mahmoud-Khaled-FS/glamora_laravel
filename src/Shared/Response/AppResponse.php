<?php

namespace Src\Shared\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class AppResponse implements Responsable
{

  public function __construct(
    public readonly mixed $data,
    public readonly int $statusCode = 200,
  ) {}

  public function toArray(): array
  {
    return [
      'success' => true,
      'statusCode' => $this->statusCode,
      'data' => $this->data,
    ];
  }

  public function toResponse($request)
  {
    return $this->toArray();
  }

  public static function created(mixed $data): self
  {
    return new self($data, 201);
  }

  public static function ok(mixed $data): self
  {
    return new self($data);
  }

  public static function noContent(): Response
  {
    return response()->noContent();
  }
}
