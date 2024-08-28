<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidedVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'phone',
        'number_of_people',
        'message',
        'pending',
        'approved',
        'date',
    ];


    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
