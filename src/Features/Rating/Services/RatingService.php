<?php

namespace Src\Features\Rating\Services;

use Src\Features\Products\Models\Product;
use Src\Features\Rating\Jobs\ProductRatingAggregatorJob;
use Src\Features\Rating\Models\Rating;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;
use Src\Shared\Utils\PaginationHelpers;

class RatingService
{
  public function getRatings(string $relatedType, int $relatedId): array
  {
    $relatedType = $this->getRetableClass($relatedType);
    $data = Rating::where("rateable_type", $relatedType)->where("rateable_id", $relatedId)->paginate();

    return ['ratings' => $data->items(), 'metadata' => PaginationHelpers::getMetadata($data)];
  }

  public function createOne(array $data, $userId): Rating
  {
    $related = match ($data['retableType']) {
      'product' =>  Product::find($data['retableId']),
      default => null
    };
    if (!$related) {
      throw AppError::NotFound("{$data['retableType']} not found");
    }
    $hasRating = $related->ratings()->where('user_id', $userId)->exists();
    if ($hasRating) {
      throw new AppError("You have already rated this {$data['retableType']}", 400, ErrorCode::ERR_REQUIREMENT_ERROR);
    }
    $rating = $related->ratings()->create([
      'rating' => $data['rating'],
      'review' => $data['review'],
      'user_id' => $userId
    ]);
    $this->dispatchAvgRating($related);
    return $rating;
  }

  public function updateOne(int $id, array $data): Rating
  {
    $rating = $this->getById($id);
    $rating->update($data);
    return $rating;
  }

  public function deleteOne(int $id): bool
  {
    $rating = $this->getById($id);
    return $rating->delete();
  }

  public function getById(int $id): Rating
  {
    $rate = Rating::find($id);
    if (!$rate) {
      throw AppError::NotFound("Rating not found");
    }
    return $rate;
  }

  public function getForUser(string $relatedType, int $relatedId, int $userId): Rating
  {
    $relatedType = $this->getRetableClass($relatedType);
    $rate = Rating::where("rateable_type", $relatedType)
      ->where("rateable_id", $relatedId)
      ->where("user_id", $userId)
      ->first();
    if (!$rate) {
      throw AppError::NotFound("Rating not found");
    }
    return $rate;
  }

  public function getAverageRating(string $relatedType, int $relatedId): float
  {
    $relatedType = $this->getRetableClass($relatedType);
    return Rating::where("rateable_type", $relatedType)->where("rateable_id", $relatedId)->avg('rating');
  }

  private function getRetableClass(string $relatedType): string
  {
    return match ($relatedType) {
      'product' => Product::class,
      default => null
    };
  }

  private function dispatchAvgRating(mixed $related)
  {
    switch (get_class($related)) {
      case Product::class:
        ProductRatingAggregatorJob::dispatch($related, $this);
        break;
    }
  }
}
