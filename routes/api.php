<?php

use App\Http\Controllers\Api as api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/visitor", [api\VisitorController::class, "show"]);
Route::post("/visitor", [api\VisitorController::class, "store"]);
Route::put("/visitor", [api\VisitorController::class, "update"]);

Route::get("/favorites", [api\FavoriteController::class, "show"]);
Route::post("/favorites/building/{building}", [api\FavoriteController::class, "store"])->name('favorite.building');
Route::post("/favorites/circuit/{circuit}", [api\FavoriteController::class, "store"])->name('favorite.circuit');
Route::delete("/favorites/building/{building}", [api\FavoriteController::class, "destroy"])->name('unfavorite.building');
Route::delete("/favorites/circuit/{circuit}", [api\FavoriteController::class, "destroy"])->name('unfavorite.circuit');

Route::get('/circuits', [api\CircuitController::class, 'show']);

Route::get('/rate/{building}', [api\RateController::class, 'show']);
Route::post('/rate', [api\RateController::class, 'store']);

Route::get('/comment/{building}', [api\CommentController::class, 'show']);
Route::post('/comment', [api\CommentController::class, 'store']);
Route::put('/comment/{comment}', [api\CommentController::class, 'update']);
Route::delete('/comment/{comment}', [api\CommentController::class, 'destroy']);

Route::get("/events", [api\EventController::class, "show"]);

// For the visitor to book or unbook an event
Route::get('/bookings', [api\BookingController::class, 'show'])->name('bookings.show');
Route::post('bookings/{event}', [api\BookingController::class, 'store'])->name('bookings.store');
Route::delete('bookings/{event}', [api\BookingController::class, 'destroy'])->name('bookings.destroy');

Route::get('/achievement', [api\AchievementController::class, 'show']);
Route::post('/achievement', [api\AchievementController::class, 'store']);

// Visitor to Request a Guided Visit
Route::post('/guided/', [api\GuidedVisitController::class, 'store']);

// When a building get visited
Route::controller(api\VisitedBuildingsController::class)->name("visited_buildings")->group(
    function () {
        Route::get("/visited_buildings", "show");
        Route::post("/visited_buildings/{building}", "store");
    }
);
