<?php

namespace App\Http\Resources;


class VisitorResource extends BaseResource
{
    protected $attributes = [
        'id',
        'first_name',
        'last_name',
        'age',
        'gender',
        'email',
        'role',
    ];
}
