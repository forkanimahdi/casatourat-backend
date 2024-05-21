<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class CircuitResource extends BaseResource
{
    protected $attributes = [
        'id',
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
