<?php

namespace Src\Features\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Shared\Utils\ModelHelper;

class CategoryResource extends JsonResource
{

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => ModelHelper::fileUrl($this->image),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
