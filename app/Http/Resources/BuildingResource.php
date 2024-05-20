<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends BaseResource
{

    protected $attributes = [
        'name',
        'description',
        'audio',
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
            'images' => $this->resource->images->map(fn ($image) => $image->path),
            'cordinates' => [
                'latitude' => $this->resource->latitude,
                'longitude' => $this->resource->longitude
            ]
        ];
    }
}
