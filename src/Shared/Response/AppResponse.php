<?php

namespace Src\Shared\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class AppResponse implements Responsable
{

  public function __construct(
    public readonly mixed $data,
    public readonly int $statusCode = Response::HTTP_OK,
  ) {}

  /**
   * @return array{
   *  success: bool,
   *  statusCode: int,
   *  data: mixed
   * }
   */
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
    /** @phpstan-ignore-next-line */
    return $this->toArray();
  }

  public static function created(mixed $data): self
  {
    return new self($data, Response::HTTP_CREATED);
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
