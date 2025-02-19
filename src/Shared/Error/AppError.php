<?php

namespace Src\Shared\Error;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppError extends \Exception
{
  protected int $statusCode;
  // TODO (MAHMOUD) - Add error type Enum
  protected string $errorCode;

  public function __construct(
    string $message,
    int $statusCode = 400,
    string $errorCode = "ERR_UNKNOWN",
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

  // TODO (MAHMOUD) - Update this function
  public static function fromLaravelException(\Throwable $exception): AppError
  {
    // ✅ Validation Error (422)
    if ($exception instanceof ValidationException) {
      return new AppError($exception->getMessage(), 422, 'validation_error', $exception);
    }

    // ✅ Authentication Error (401)
    if ($exception instanceof AuthenticationException) {
      return new AppError($exception->getMessage(), 401, 'unauthenticated', $exception);
    }

    // ✅ Model Not Found (404)
    if ($exception instanceof ModelNotFoundException) {
      return new AppError($exception->getMessage(), 404, 'not_found', $exception);
    }

    // ✅ Generic HTTP Errors (403, 500, etc.)
    if ($exception instanceof HttpException) {
      return new AppError($exception->getMessage(), $exception->getStatusCode(), 'http_error', $exception);
    }

    // ✅ Handle AppError itself (don't wrap it again)
    if ($exception instanceof AppError) {
      return $exception;
    }

    // ✅ Catch Everything Else (500)
    return new AppError('Something went wrong', 500, 'server_error', $exception);
  }
}
