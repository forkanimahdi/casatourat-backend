<?php

namespace App\Http\Resources;


class VisitorResource extends BaseResource
{
    protected $attributes = [
        'full_name',
        'birthday',
        'gender',
        'role',
        'email',
    ];
}
