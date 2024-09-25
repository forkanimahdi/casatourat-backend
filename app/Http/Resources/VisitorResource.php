<?php

namespace App\Http\Resources;


class VisitorResource extends BaseResource
{
    protected $attributes = [
        'full_name',
        'gender',
        'role',
        'email',
        'avatar',
        'expoToken',
    ];
}
