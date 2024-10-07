<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'circuit_id',
        'name',
        'description',
        'audio',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'name' => 'object',
        'description' => 'object',
        'audio' => 'object',
    ];

    
    
    public function circuits()  
    {
        return $this->belongsToMany(Circuit::class, 'building_circuit');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function rates()
    {
        return $this->belongsToMany(Visitor::class, 'rates');
    }

    public function comments()
    {
        return $this->belongsToMany(Visitor::class, 'comments')->withPivot('content', 'id', 'status');
    }

    public function building_achievements()
    {
        return $this->belongsToMany(Visitor::class, 'achievements');
    }
    public function customizeCircuit()
    {
        return $this->belongsToMany(CustomizeCircuit::class, 'building_customize_circuits');
    }

    public function visitors()
    {
        return $this->belongsToMany(Visitor::class, 'visited_buildings');
    }

    public function is_visited_by(string $token)
    {
        foreach ($this->visitors as $visitor) {
            if ($visitor->token == $token) {
                return true;
            }
        }
        return false;
    }
}
