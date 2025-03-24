<?php

namespace Src\Features\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Shared\Utils\ModelHelper;
use Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'summary' => $this->summary,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'image' => ModelHelper::fileUrl($this->image),
            'images' => $this->whenLoaded('images', fn() => $this->images->map(fn($image) => Storage::url($image->image))),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'videoUrl' => $this->video_url,
            'quantity' => $this->quantity,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
