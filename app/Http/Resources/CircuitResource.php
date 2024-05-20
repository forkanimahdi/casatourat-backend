<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CircuitResource extends BaseResource
{
    protected $attributes = [
        'name',
        'alternative',
        'description',
        'audio',
        'headpoint',
        'zoom',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'path' => PathResource::collection($this->resource->paths),
            'images' => $this->resource->images->map(fn ($image) => $image->path),
            'buildings' => BuildingResource::collection(($this->resource->buildings))
        ];
    }
}
