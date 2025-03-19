<?php

namespace Src\Shared\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Spatie\LaravelData\Data;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class AppJsonRequest extends FormRequest
{
  protected $stopOnFirstFailure = true;

  public function authorize(): bool
  {
    return true;
  }

  public function validationData(): array
  {
    return $this->post();
  }

  public function failedValidation(Validator $validator)
  {
    $exception = $validator->getException();

    throw new AppError($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, ErrorCode::ERR_VALIDATION_ERROR);
  }

  /**
   * @template T of Data
   * @param class-string<T> $dto
   * @param array|null $default
   * @return Data
   */
  public function toDTO(string $dto, ?array $default): Data
  {
    $data = $this->validated();
    if ($default && count($default) !== 0) {
      $data = array_merge($data, $default);
    }
    return $dto::from($data);
  }
}
