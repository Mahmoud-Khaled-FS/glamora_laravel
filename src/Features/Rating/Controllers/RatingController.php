<?php

namespace Src\Features\Rating\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Src\Features\Rating\Services\RatingService;
use Src\Features\Rating\Requests\StoreRatingRequest;
use Src\Features\Rating\Requests\UpdateRatingRequest;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;
use Src\Shared\Response\AppResponse;

class RatingController
{
  public function __construct(private readonly RatingService $ratingService) {}

  public function index(Request $request): AppResponse
  {
    $this->validateGetQuery($request);
    $response = $this->ratingService->getRatings($request->query('retable_type'), $request->query('retable_id'));
    return AppResponse::ok($response['ratings'], $response['metadata']);
  }

  public function myRate(Request $request): AppResponse
  {
    $this->validateGetQuery($request);
    $rate = $this->ratingService->getForUser($request->query('retable_type'), $request->query('retable_id'), Auth::id());
    return AppResponse::ok($rate);
  }

  public function show(int $id): AppResponse
  {
    return AppResponse::ok($this->ratingService->getById($id));
  }

  public function store(StoreRatingRequest $request): AppResponse
  {
    return AppResponse::created($this->ratingService->createOne($request->bodyMapped(), Auth::id()));
  }

  public function update(UpdateRatingRequest $request, int $id): Response
  {
    $rate = $this->ratingService->getById($id);
    // TODO (MAHMOUD) - use helper class that take message and validator
    if (!Gate::allows('update', $rate)) {
      throw AppError::unauthorized('You are not allowed to delete this rating');
    };
    $this->ratingService->updateOne($id, $request->bodyMapped());
    return AppResponse::noContent();
  }

  public function destroy(int $id): Response
  {
    $rate = $this->ratingService->getById($id);
    if (!Gate::allows('delete', $rate)) {
      throw AppError::unauthorized('You are not allowed to delete this rating');
    };
    $this->ratingService->deleteOne($id);
    return AppResponse::noContent();
  }

  public function getProductRatings(int $productId): AppResponse
  {
    return AppResponse::ok($this->ratingService->getRatings('product', $productId));
  }

  private function validateGetQuery(Request $request)
  {
    $validator = Validator::make($request->query(), [
      'retable_type' => ['required', 'in:product'],
      'retable_id' => ['required', 'numeric'],
    ]);
    if ($validator->fails()) {
      throw new AppError($validator->errors()->first(), Response::HTTP_BAD_REQUEST, ErrorCode::ERR_VALIDATION_ERROR);
    }
  }
}
