<?php

use App\Http\Controllers\Api as api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/visitor", [api\VisitorController::class, "store"]);
Route::get("/favorites", [api\FavoriteController::class, "index"]);
Route::post("/favorites/{building}", [api\FavoriteController::class, "store"]);


Route::get('/circuits', [api\CircuitController::class, 'index']);
Route::post('/comment', [api\CommentController::class, 'store']);
Route::post('/rate', [api\RateController::class, 'store']);
