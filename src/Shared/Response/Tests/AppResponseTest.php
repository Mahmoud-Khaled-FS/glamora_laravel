<?php

use Illuminate\Http\Response;
use Src\Shared\Response\AppResponse;

test('App Response Should Return Json', function () {
  $response = new AppResponse("Response data", 200);
  expect($response->toArray())
    ->toMatchArray([
      'success' => true,
      'statusCode' => 200,
      'data' => "Response data",
    ]);
  $response = AppResponse::created("Response data");
  expect($response->toArray())
    ->toMatchArray([
      'success' => true,
      'statusCode' => 201,
      'data' => "Response data",
    ]);
  $response = AppResponse::ok("Response data");
  expect($response->toArray())
    ->toMatchArray([
      'success' => true,
      'statusCode' => 200,
      'data' => "Response data",
    ]);
  $response = AppResponse::noContent();
  expect($response)->toBeInstanceOf(Response::class);
});
