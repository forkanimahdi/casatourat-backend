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
// * store the infos of the circuit
Route::post('circuit/store', [CircuitController::class, 'post'])->name('circuit.post');
// * get the map of adding path of the circuit
Route::get('circuit/map/{circuit}', [CircuitController::class, 'circuit_map_index'])->name('circuit.index');
// ^ post the path (this function is called from circuit map using axios post)
Route::post('circuit/path_post', [CircuitController::class, 'path_post'])->name('circuit.path_post');
// * get the map of assign buildings to the circuit that has been created
Route::get('assign_building/map/{id}', [CircuitController::class, 'assign_building_index'])->name('assign_building.index');

Route::put('circuit/assign_building/{buildign}', [CircuitController::class, 'assign_building'])->name('circuit.assign_building');
Route::put('circuit/unassign_building', [CircuitController::class, 'unassign_building'])->name('circuit.unassign_building');

Route::get('building/map', [BuildingController::class, 'building_map_index'])->name('building.index');
Route::post('circuit/buildign_post', [BuildingController::class, 'buildign_post'])->name('circuit.buildign_post');
Route::delete('circuit/delete_building', [BuildingController::class, 'delete_building'])->name('circuit.delete_building');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
