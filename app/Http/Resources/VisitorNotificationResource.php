<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorNotificationResource extends JsonResource
{
    protected $attributes = [
        'id',
        'visitor_id',
        'type',
        'title',
        'content',
        'circuit_id',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
