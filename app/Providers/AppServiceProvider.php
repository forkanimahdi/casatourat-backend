<?php

namespace App\Providers;

use App\Models\Building;
use App\Models\Comment;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $reviews = Comment::orderBy('created_at', 'desc')->get();
        $notif = Comment::where('mark_read', false)->get();
        $buildings = Building::all();
        view()->share(['reviews' => $reviews, 'notif' => $notif, 'buildings' => $buildings]);


        $visitors = Visitor::all();
        view()->share([
            "visitors" => $visitors,
        ]);
    }
}
