<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'circuit_id',
        'content',
        'status',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }
}
