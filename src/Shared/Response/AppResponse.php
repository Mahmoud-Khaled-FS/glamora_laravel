<?php

namespace Src\Shared\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class AppResponse implements Responsable
{

  public function __construct(
    public readonly mixed $data,
    public readonly int $statusCode = Response::HTTP_OK,
    public readonly mixed $metadata = null
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
      'metadata' => $this->metadata
    ];
  }

  public function toResponse($request)
  {
    /** @phpstan-ignore-next-line */
    return $this->toArray();
  }

  public static function created(mixed $data, mixed $metadata = null): self
  {
    return new self($data, Response::HTTP_CREATED, $metadata);
  }

  public static function ok(mixed $data, mixed $metadata = null): self
  {
    return new self($data, Response::HTTP_OK, $metadata);
  }

  public static function noContent(): Response
  {
    return response()->noContent();
  }
}
