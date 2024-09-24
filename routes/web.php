<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\CustomizeCircuitController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as api;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\GuidedVisitController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [Controller::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/circuit', [CircuitController::class, 'index'])->name('circuit.index');
Route::get('/circuit/customize', [CustomizeCircuitController::class, 'index'])->name('customize');
Route::post('/circuit/customize/store', [CustomizeCircuitController::class, 'store'])->name('customize.store');
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


// & building routes: this is a simplified way to put all the routes in one place
Route::resource('buildings', BuildingController::class);

Route::post('buildings/image/{building}', [BuildingController::class, 'store_image'])->name('buildings.store_image');
Route::put('buildings/image/{image}', [BuildingController::class, 'update_image'])->name('buildings.update_image');
Route::delete('buildings/image/{image}', [BuildingController::class, 'destory_image'])->name('buildings.destory_image');

// * Events :
Route::resource('events', EventController::class);
Route::get('/send', [EventController::class, 'sendNotif'])->name('event.send');
Route::post('/events/{event}/store_images', [EventController::class, 'store_image'])->name('event.store_image');
Route::delete('events/{event}/delete_image/{image}', [EventController::class, 'destory_image'])->name('events.delete_image');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// users
Route::resource('users', VisitorController::class)->except([
    'create',
    'edit',
    'update',
    'destroy'
]);


// & staff routes :
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index')->middleware('auth');

// & comments :
Route::get('/notiffication/{review}', [CommentController::class, 'show'])->name('notif.show');
Route::get('/notiffication', [CommentController::class, 'index'])->name('notif.index');
Route::delete('/comments/delete/{r.eview}', [CommentController::class, 'destroy'])->name('notif.delete');
Route::post('create/notif', [CommentController::class, 'store'])->name('create_comment');
Route::put('/update/notif/{review}', [CommentController::class, 'update'])->name('update.notif');
Route::put('/update/allnotif', [CommentController::class, 'asread'])->name('update.allnotif');

Route::get("/visitors", [api\VisitorController::class, "index"])->middleware(['auth', 'verified']);
Route::get('/reviews', [api\CommentController::class, "show"])->middleware(['auth', 'verified']);


Route::get('/guided_visits', [GuidedVisitController::class, 'index'])->name('guided.index');
Route::post('/guided_visits/clearance/{visit}', [GuidedVisitController::class, 'clearance'])->name('guided.clearance');

require __DIR__ . '/auth.php';
