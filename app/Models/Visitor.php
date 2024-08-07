<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "email",
        "token",
        "gender",
        "birthday",
        "role",
        "avatar"
    ];

    public function favorites()
    {
        return $this->belongsToMany(Building::class, "favorites");
    }

    public function rates()
    {
        return $this->belongsToMany(Building::class, "rates");
    }

    public function comments()
    {
        return $this->belongsToMany(Building::class, "comments")->withPivot('content', 'id', 'status', 'created_at');
    }

    public function visits()
    {
        return $this->belongsToMany(Building::class, 'achievements');
    }
}
