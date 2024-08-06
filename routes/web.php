<?php

use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as api;
use App\Http\Controllers\dashboardController;

Route::get('/', function () {

    return view('welcome');
});


Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth' , 'verified'])->name('dashboard');

// Route::get('/dashboard', [Controller::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/circuit', [CircuitController::class, 'index'])->name('circuit.index');
// & circuit routes:
Route::get('circuit/create', [CircuitController::class, 'create'])->name('circuit.create');
Route::post('circuit/store', [CircuitController::class, 'post'])->name('circuit.post');
Route::get('circuit/show/{circuit}', [CircuitController::class, 'show'])->name('circuit.show');
Route::get('circuit/assign_building/map/{id}', [CircuitController::class, 'assign_building_index'])->name('assign_building.index');
Route::put('circuit/assign_building/{buildign}', [CircuitController::class, 'assign_building'])->name('circuit.assign_building');
Route::put('circuit/unassign_building', [CircuitController::class, 'unassign_building'])->name('circuit.unassign_building');
Route::put('circuit/update_draft/{circuit}', [CircuitController::class, 'update_draft'])->name('circuit.update_draft');
Route::get('circuit/update/map/{circuit}', [CircuitController::class, 'update_map'])->name('circuit.update_map');
Route::put('circuit/update_circuit/{id}', [CircuitController::class, 'update_circuit']);
Route::put('circuit/update/{circuit}', [CircuitController::class, 'update'])->name('circuit.update');

// Route::put('circuit/update/{circuit}', [CircuitController::class, 'update'])->name('circuit.update');
Route::post('circuit/update/{id}', [CircuitController::class, 'update'])->name('circuit.update');
Route::delete('circuit/delete/{circuit}', [CircuitController::class, 'destroy'])->name('circuit.destroy');


// & building routes:
Route::get('buildings', [BuildingController::class, 'index'])->name('building.index');
Route::get('building/{building}', [BuildingController::class, 'details'])->name('building.detail');
Route::get('buildings/create', [BuildingController::class, 'create'])->name('building.create');
Route::post('building/store', [BuildingController::class, 'store'])->name('building.store');
Route::delete('building/destroy/{id}', [BuildingController::class, 'destroy'])->name('building.destroy');
Route::put('buildings/update/{building}', [BuildingController::class, 'update'])->name('building.update');
Route::post('building/image/{building}', [BuildingController::class, 'store_image'])->name('building.store_image');
Route::put('building/image/{image}', [BuildingController::class, 'update_image'])->name('building.update_image');
Route::delete('building/image/{image}', [BuildingController::class, 'destory_image'])->name('building.destory_image');

// & add account routes:
Route::get('/register_user', [AdminRegisterController::class, 'index'])->name('register_user.index')->middleware('auth');
Route::post('/register_user', [AdminRegisterController::class, 'store'])->name('register_user.store')->middleware('auth');

// * Events :
Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/update/{event}', [EventController::class, 'show'])->name('events.show');
// * add
Route::post('/event/post', [EventController::class, 'post'])->name('event.post');
// * update
Route::put('/event/update/{event}' , [EventController::class , 'update'])->name('events.update');
// * delete
Route::delete('event/delete/{event}' , [EventController::class , 'destroy'])->name('events.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// users
Route::name("users")->group(function () {
    Route::get('/users', [VisitorController::class, 'index'])->name('.index');
    Route::post('/users', [VisitorController::class, 'store'])->name('.store');
    Route::get('/users/{visitor}', [VisitorController::class, 'show'])->name('.show');
});


// & staff routes :
Route::get('/staff', [StaffController::class,'index'])->name('staff.index')->middleware('auth');

// & comments : 
Route::get('/notiffication/{review}', [CommentController::class, 'show'])->name('notif.show');
Route::get('/notiffication', [CommentController::class, 'index'])->name('notif.index');
Route::delete('/comments/delete/{r.eview}',[CommentController::class, 'destroy'])->name('notif.delete');
Route::post('create/notif', [CommentController::class, 'store'])->name('create_comment');
Route::put('/update/notif/{review}', [CommentController::class, 'update'])->name('update.notif');
Route::put('/update/allnotif', [CommentController::class, 'asread'])->name('update.allnotif');

Route::get("/visitors", [api\VisitorController::class, "index"])->middleware(['auth', 'verified']);
Route::get('/reviews', [api\CommentController::class, "show"])->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
