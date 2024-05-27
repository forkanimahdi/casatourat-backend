<?php

use App\Http\Controllers\AdminRegisterController;
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


Route::get('/circuit', [CircuitController::class, 'index'])->name('circuit.index');
// & circuit routes:
Route::get('circuit/create', [CircuitController::class, 'create'])->name('circuit.create');
Route::post('circuit/store', [CircuitController::class, 'post'])->name('circuit.post');
Route::get('circuit/map/{circuit}', [CircuitController::class, 'circuit_map_index'])->name('circuit.map_index');
Route::post('circuit/path_post', [CircuitController::class, 'path_post'])->name('circuit.path_post');
Route::get('circuit/assign_building/map/{id}', [CircuitController::class, 'assign_building_index'])->name('assign_building.index');
Route::put('circuit/assign_building/{buildign}', [CircuitController::class, 'assign_building'])->name('circuit.assign_building');
Route::put('circuit/unassign_building', [CircuitController::class, 'unassign_building'])->name('circuit.unassign_building');

Route::put('circuit/update_draft/{circuit}', [CircuitController::class, 'update_draft'])->name('circuit.update_draft');

Route::delete('circuit/delete/{circuit}', [CircuitController::class, 'destroy'])->name('circuit.destroy');

// & building routes:
Route::get('building', [BuildingController::class, 'index'])->name('building.index');
Route::get('building/create', [BuildingController::class, 'create'])->name('building.create');
Route::post('building/store', [BuildingController::class, 'store'])->name('building.store');
Route::delete('building/destroy/{id}', [BuildingController::class, 'destroy'])->name('building.destroy');


// & add account routes:
Route::get('/register_user', [AdminRegisterController::class, 'index'])->name('register_user.index')->middleware('auth');
Route::post('/register_user', [AdminRegisterController::class, 'store'])->name('register_user.store')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
