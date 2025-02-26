<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'type',
        'title',
        'content',
        'circuit_id'
    ];

    protected $casts = [
        'title',
        'content'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
