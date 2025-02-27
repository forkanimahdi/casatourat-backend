<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
            $manager = new ImageManager(new Driver());
            foreach ($images as $image) {
                
                $imageName = time() . '_' . $image->getClientOriginalName();
                $ressource->images()->create([
                    'path' => $imageName
                ]);
                if ($image->getSize() >= 1024) {
                    
                    $compressedImage = $manager->read($image)->toJpeg(75); 
                    Storage::disk('public')->put("images/{$imageName}", (string) $compressedImage);   
                }else{
                    $image->storeAs('images', $imageName, 'public');
                }
                }
        }
    }

    public function erase()
    {
        Storage::disk('public')->delete('images/' . $this->path);
        $this->delete();
    }
}
