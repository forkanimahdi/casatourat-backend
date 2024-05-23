<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CircuitResource extends BaseResource
{
    protected $attributes = [
        'id',
        'name',
        'alternative',
        'description',
        'audio',
        'published',
    ];

    public function isNew($updated_at)
    {
        if ($updated_at) {
            $startDate = Carbon::now()->format('Y-m-d H:i:s');
            $endDate = $updated_at->addDays(15)->format('Y-m-d H:i:s');
            if ($startDate >= $endDate) {
                return false;
            }
            return true;
        }
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [            ...parent::toArray($request),
            'path' => PathResource::collection($this->resource->paths),
            'images' => $this->resource->images->map(fn ($image) => $image->path),
            'new' => $this->isNew($this->resource->updated_at) ?? false,
            'buildings' => BuildingResource::collection(($this->resource->buildings)),
        ];
    }
}
