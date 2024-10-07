<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        "path"
    ];

    public function videoable() {
        return $this->morphTo();
    }
    static function store($ressource, $videos) {
        if ($videos) {
            foreach ($videos as $key => $video) {
                $fileName = time() . '_' . $video->getClientOriginalName();
                $ressource->videos()->create([
                    'path' => $fileName
                ]);
                $video->storeAs('videos', $fileName, 'public');
            }
        }
    }
}
