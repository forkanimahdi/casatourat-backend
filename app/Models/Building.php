<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

class Building extends Model
{
    use HasFactory;


    protected $fillable = [
        'circuit_id',
        'name',
        'description',
        'audio',
        'latitude',
        'longitude',
    ];

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function rates()
    {
        return $this->belongsToMany(Visitor::class, 'rates');
    }

    public function comments()
    {
        return $this->belongsToMany(Visitor::class, 'comments')->withPivot('content', 'id','status');
    }

    public function building_achievements()
    {
        return $this->belongsToMany(Visitor::class, 'achievements');
    }
}
