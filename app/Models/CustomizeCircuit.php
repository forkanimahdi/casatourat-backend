<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeCircuit extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "visitor_id",
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
    public function buildings() {
        return $this->belongsToMany(Building::class, "building_customize_circuits");
    }
}
