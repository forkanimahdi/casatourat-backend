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
        // dd('test');
        $data = parent::toArray($request);
        $audios = $data['audio'];
        $audioDurations = [];
        // dd($audios);

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

        // dd($audioDurations);
        return [
            ...parent::toArray($request),
            'audiosDuration' => $audioDurations,
            'images' => $this->resource->images->map(fn($image) => $image->path),
            'videos' => $this->resource->videos->map(fn($video) => $video->path),
            'path' => PathResource::collection($this->resource->paths),
            'new' => $this->isNew($this->resource->updated_at) ?? false,
            'buildings' => BuildingResource::collection($this->resource->buildings),
        ];
    }
}
