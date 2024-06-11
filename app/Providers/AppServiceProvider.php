<?php

namespace App\Providers;

use App\Models\Visitor;
use App\Models\Comment;
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
        $visitors = Visitor::all();
        view()->share([
            "visitors" => $visitors,
        ]);

        $reviews = Comment::orderBy('created_at', 'desc')->get();
        $notif = Comment::where('mark_read', false)->get();
        view()->share(['reviews' => $reviews, 'notif' => $notif]);
    }
}
