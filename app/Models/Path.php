<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;
    protected $fillable = [
        'circuit_id',
        'latitude',
        'longitude',
    ];

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }
}
