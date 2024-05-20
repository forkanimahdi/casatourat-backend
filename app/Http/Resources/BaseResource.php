<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected $attributes = [];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_filter(
            $this->resource->toArray(),
            fn ($key) => in_array($key, $this->attributes),
            ARRAY_FILTER_USE_KEY,
        );
    }
}
