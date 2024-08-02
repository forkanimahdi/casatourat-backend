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
Route::post("/favorites/{building}", [api\FavoriteController::class, "store"]);
Route::delete("/favorites/{building}", [api\FavoriteController::class, "destroy"]);

Route::get('/circuits', [api\CircuitController::class, 'show']);

Route::get('/rate/{building}', [api\RateController::class, 'show']);
Route::post('/rate', [api\RateController::class, 'store']);

Route::get('/comment/{building}', [api\CommentController::class, 'show']);
Route::post('/comment', [api\CommentController::class, 'store']);
Route::put('/comment/{comment}', [api\CommentController::class, 'update']);
Route::delete('/comment/{comment}', [api\CommentController::class, 'destroy']);

Route::get("/events", [api\EventController::class, "show"]);

Route::get('/achievement', [api\AchievementController::class, 'show']);
Route::post('/achievement', [api\AchievementController::class, 'store']);
