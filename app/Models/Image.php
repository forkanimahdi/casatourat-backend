<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
    ];

    public function imagable(): MorphTo
    {
        return $this->morphTo();
    }

    static function store($ressource, $images)
    {
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $ressource->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }
    }

    public function erase()
    {
        Storage::disk('public')->delete('images/' . $this->path);
        $this->delete();
    }
}
