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
        // send audios durations 
        $audioDurations = [];
        $data = parent::toArray($request);
        $audios = $data['audio'];

        foreach ($audios as $key => $audio) {
            $audioFilePath = storage_path('app/public/audios/' . $audio);

            if (file_exists($audioFilePath)) {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($audioFilePath);
                $audioDurations[$key] = isset($fileInfo['playtime_seconds']) ? round(($fileInfo['playtime_seconds']) * 1000) : 'Unknown duration';
            } else {
                $audioDurations[$key] = 'File not found';
            }
        }
        return [
            ...parent::toArray($request),
            'audiosDuration' => $audioDurations,
            'images' => $this->resource->images->map(fn($image) => $image->path),
            'videos' => $this->resource->videos->map(fn($video) => $video->path),
            'coordinate' => [
                'latitude' => $this->resource->latitude,
                'longitude' => $this->resource->longitude
            ],
            'average_rate' => $this->resource->rates->avg('value') ?? 0,
            'visited' => $request->header('Token') ? $this->resource->is_visited_by($request->header('Token')) : false,
        ];
    }
}
