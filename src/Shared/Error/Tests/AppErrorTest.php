<?php

use Illuminate\Http\JsonResponse;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

test('Error Response Should Return Json', function () {
  $error = new AppError("Error Message", 400, ErrorCode::ERR_UNKNOWN);
  expect($error->toArray())
    ->toMatchArray([
      'success' => false,
      'statusCode' => 400,
      'errorCode' => ErrorCode::ERR_UNKNOWN,
      'message' => "Error Message",
    ]);

  expect($error->render())
    ->toBeInstanceOf(JsonResponse::class);
});
