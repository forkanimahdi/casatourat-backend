<?php

namespace App\Http\Resources;


class VisitorResource extends BaseResource
{
    protected $attributes = [
        'first_name',
        'last_name',
        'age',
        'gender',
    ];
}
