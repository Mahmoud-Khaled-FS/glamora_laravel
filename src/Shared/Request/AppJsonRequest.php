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

  protected $fields = null;
  protected $isFormData = false;


  public function authorize(): bool
  {
    return true;
  }

  public function validationData(): array
  {
    if ($this->isFormData) {
      return parent::validationData();
    }
    return $this->post();
  }

  public function failedValidation(Validator $validator)
  {
    $message = $validator->getMessageBag()->first();
    throw new AppError($message, Response::HTTP_UNPROCESSABLE_ENTITY, ErrorCode::ERR_VALIDATION_ERROR);
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

  public function bodyMapped(): array
  {
    $data = $this->validated();
    if ($this->fields) {
      $newData = [];
      foreach ($data as $key => $_) {
        if (key_exists($key, $this->fields)) {
          $newData[$this->fields[$key]] = $data[$key];
        } else {
          $newData[$key] = $data[$key];
        }
      }
      return $newData;
    }
    return $data;
  }
}
