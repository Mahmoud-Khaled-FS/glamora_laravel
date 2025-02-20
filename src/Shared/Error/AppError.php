<?php

namespace Src\Shared\Error;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppError extends \Exception
{
  protected int $statusCode;
  protected string $errorCode;

  public function __construct(
    string $message,
    int $statusCode = Response::HTTP_BAD_REQUEST,
    string $errorCode = ErrorCode::ERR_UNKNOWN,
    private readonly mixed $previous = null
  ) {
    parent::__construct($message);
    $this->statusCode = $statusCode;
    $this->errorCode = $errorCode;
  }

  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  public function getErrorCode(): string
  {
    return $this->errorCode;
  }

  public function toArray(): array
  {
    $err = [
      'success' => false,
      'statusCode' => $this->statusCode,
      'errorCode' => $this->errorCode,
      'message' => $this->getMessage(),
    ];
    if (config('app.debug')) {
      $err['devError'] = $this->previous;
      $err['trace'] = $this->getTrace();
    }
    return $err;
  }

  public function render(): JsonResponse
  {
    return response()->json($this->toArray(), $this->statusCode);
  }

  public static function fromLaravelException(\Throwable $exception): AppError
  {
    // ✅ Validation Error (422)
    if ($exception instanceof ValidationException) {
      return new AppError($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, ErrorCode::ERR_VALIDATION_ERROR, $exception);
    }

    // ✅ Authentication Error (401)
    if ($exception instanceof AuthenticationException) {
      return new AppError($exception->getMessage(), Response::HTTP_UNAUTHORIZED, ErrorCode::ERR_UNAUTHORIZED, $exception);
    }

    // ✅ Model Not Found (404)
    if ($exception instanceof ModelNotFoundException) {
      return new AppError($exception->getMessage(), Response::HTTP_NOT_FOUND, ErrorCode::ERR_NOT_FOUND, $exception);
    }

    // ✅ Generic HTTP Errors (403, 500, etc.)
    if ($exception instanceof HttpException) {
      return new AppError($exception->getMessage(), $exception->getStatusCode(), ErrorCode::ERR_UNKNOWN, $exception);
    }

    // ✅ Handle AppError itself (don't wrap it again)
    if ($exception instanceof AppError) {
      return $exception;
    }

    // ✅ Catch Everything Else (500)
    return new AppError('Something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR, ErrorCode::ERR_SERVER_ERROR, $exception);
  }
}
