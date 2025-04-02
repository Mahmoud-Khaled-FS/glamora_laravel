<?php

namespace Src\Features\Rating\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Src\Features\Products\Models\Product;
use Src\Features\Rating\Services\RatingService;

class ProductRatingAggregatorJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Product $product, private readonly RatingService $ratingService)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->product->rating = $this->ratingService->getAverageRating(Product::class, $this->product->id);
        $this->product->save();
    }

    public function uniqueId(): int
    {
        return $this->product->id;
    }
}
