<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monument extends Model
{
    use HasFactory;

    protected $table = "monuments";

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'name' => 'object', // This is the default for JSON fields (object)
        'description' => 'object',
    ];

    // Accessor for turning the 'name' array into an object
    // public function getNameAttribute($value)
    // {
    //     return json_decode($value); // Converts array to object
    // }

    // public function getDescriptionAttribute($value)
    // {
    //     return json_decode($value); // Converts array to object
    // }
}
