<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alternative',
        'description',
        'audio',
        'published'
    ];

    protected $casts = [
        'name' => 'object',
        'description' => 'object',
        'audio' => 'object',
        'published' => 'boolean',
    ];
    
    public function buildings()
    {
        return $this->belongsToMany(Building::class, 'building_circuit');
    }
    public function paths()
    {
        return $this->hasMany(Path::class);
    }

    
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function guided_visits()
    {
        return $this->hasMany(GuidedVisit::class);
    }

    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }
    
    public function comments()
    {
        return $this->belongsToMany(Visitor::class, 'comments')->withPivot('content', 'id', 'status');
    }
}
