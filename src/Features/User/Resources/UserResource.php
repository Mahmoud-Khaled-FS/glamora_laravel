<?php

namespace Src\Features\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Shared\Utils\ModelHelper;

class UserResource extends JsonResource
{

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'avatar' => ModelHelper::fileUrl($this->avatar),
            'dateOfBirth' => $this->date_of_birth,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
