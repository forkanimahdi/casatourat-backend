<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class EventResource extends BaseResource
{
    protected $attributes = [
        'title',
        'description',
        'start',
        'end',
        'image',
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
            'start' => $this->resource->start->format("d M Y H:i a"),
            'end' => $this->resource->end->format("d M Y H:i a"),
        ];
    }
}
