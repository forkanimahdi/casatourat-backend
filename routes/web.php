<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/circuit', [CircuitController::class, 'index']);
// & circuit routes:
Route::get('circuit/create', [CircuitController::class, 'create'])->name('circuit.create');
Route::post('circuit/store', [CircuitController::class, 'post'])->name('circuit.post');
Route::get('circuit/map/{circuit}', [CircuitController::class, 'circuit_map_index'])->name('circuit.index');
Route::post('circuit/path_post', [CircuitController::class, 'path_post'])->name('circuit.path_post');
Route::get('circuit/assign_building/map/{id}', [CircuitController::class, 'assign_building_index'])->name('assign_building.index');

Route::put('circuit/assign_building/{buildign}', [CircuitController::class, 'assign_building'])->name('circuit.assign_building');
Route::put('circuit/unassign_building', [CircuitController::class, 'unassign_building'])->name('circuit.unassign_building');

// & building routes: 
Route::get('building/create', [BuildingController::class, 'create'])->name('building.create');
Route::post('building/store', [BuildingController::class, 'store'])->name('building.store');
Route::delete('building/destroy', [BuildingController::class, 'destroy'])->name('building.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
