<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Circuit extends Model
{
    use HasFactory;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'alternative',
        'description',
        'audio',
        'published'
    ];

    public function paths()
    {
        return $this->hasMany(Path::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }
    
}
