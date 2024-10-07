<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidedVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        // form information
        'visitor_id',
        'circuit_id',
        'phone',
        'number_of_people',
        'date',
        'time',
        'nationality',
        'city',
        'reason',
        'language',
        'receipt',
        'validate',

        // backend info
        'pending',
        'approved',
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
