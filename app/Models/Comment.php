<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'building_id',
        'content',
        'status',
        'mark_read',
    ];


    public function visitor(){
        return $this->belongsTo(Visitor::class);
    }
    public function building(){
        return $this->belongsTo(Building::class);
    }
}
