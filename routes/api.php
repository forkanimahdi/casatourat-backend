<?php

use App\Http\Controllers\Api as api;
use App\Http\Controllers\BuildingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/visitor", [api\VisitorController::class, "store"]);
Route::put("/visitor", [api\VisitorController::class, "update"]);

Route::get("/favorites", [api\FavoriteController::class, "index"]);
Route::post("/favorites/{building}", [api\FavoriteController::class, "store"]);
Route::delete("/favorites/{building}", [api\FavoriteController::class, "destroy"]);

Route::get('/circuits', [api\CircuitController::class, 'index']);
Route::get('/rate/{building}', [api\RateController::class, 'index']);
Route::post('/rate', [api\RateController::class, 'store']);
Route::get('/comment/{building}', [api\CommentController::class, 'index']);
Route::post('/comment', [api\CommentController::class, 'store']);
Route::put('/comment/{comment}', [api\CommentController::class, 'update']);
Route::delete('/comment/{comment}', [api\CommentController::class, 'destroy']);

