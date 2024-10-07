<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingResource extends BaseResource
{

    protected $attributes = [
        'id',
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
            'images' => $this->resource->images->map(fn($image) => $image->path),
            'videos' => $this->resource->videos->map(fn($video) => $video->path),
            'coordinate' => [
                'latitude' => $this->resource->latitude,
                'longitude' => $this->resource->longitude
            ],
            'average_rate' => $this->resource->rates->avg('value') ?? 0,
            'visited' => $this->resource->is_visited_by($request->header('Token')), 
        ];
    }
}
