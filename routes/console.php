<?php

use App\Models\Monument;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('fill', function () {
    Monument::create(
        [
            'name' => [
                'en' => 'Grand Prix Circuit',
                'fr' => 'Circuit Grand Prix',
                'ar' => 'دائرة الجائزة الكبرى'
            ],
            'description' => [
                'en' => 'A prestigious racing circuit.',
                'fr' => 'Un circuit prestigieux de course.',
                'ar' => 'دائرة سباق مرموقة.'
            ]
        ]
    );
});

Artisan::command('show', function () {
    $monument = Monument::find(1);
    dd($monument->description->en);
});
