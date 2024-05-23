<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'visitor_id',
        'value',
    ];


    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
