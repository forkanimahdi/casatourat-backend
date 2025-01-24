<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\CustomizeCircuitController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as api;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\GuidedVisitController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/termsofuse', function () {
    return view('terms.terms_and_policy');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [Controller::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/circuit/customize', [CustomizeCircuitController::class, 'index'])->name('customize');
Route::post('/circuit/customize/store', [CustomizeCircuitController::class, 'store'])->name('customize.store');

// images
Route::controller(ImageController::class)->name('images.')->group(function () {
    Route::post('/images/store/{ressource}', 'store')->name('store');
    Route::delete('/images/destroy/{image}', 'destroy')->name('destroy');
});

// videos
Route::controller(VideoController::class)->name('videos.')->group(function () {
    Route::post('/videos/store/{ressource}', 'store')->name('store');
    Route::delete('/videos/destroy/{video}', 'destroy')->name('destroy');
});
// & circuit routes:
Route::resource('circuits', CircuitController::class);

Route::controller(CircuitController::class)->name('circuits.')->group(function () {
    Route::patch('circuits/publish/{circuit}', 'publish')->name('publish');
    Route::patch('circuits/unpublish/{circuit}', 'unpublish')->name('unpublish');
    Route::post("/update/path/{id}", 'updatePath')->name('updatepath');
});

// Route::patch('circuits/assign_building/{building}', [BuildingController::class, 'assign_building'])->name('assign');
// Route::patch('circuits/unassign_building/{building}', [BuildingController::class, 'unassign_building'])->name('buildings.unassign');

// Route::put('circuit/unassign_building', [CircuitController::class, 'unassign_building'])->name('circuit.unassign_building');
Route::put('circuit/update_draft/{circuit}', [CircuitController::class, 'update_draft'])->name('circuit.update_draft');
Route::get('circuit/update/map/{circuit}', [CircuitController::class, 'update_map'])->name('circuit.update_map');
Route::put('circuit/update_circuit/{id}', [CircuitController::class, 'update_circuit']);


// & building routes: this is a simplified way to put all the routes in one place
Route::resource('buildings', BuildingController::class);

Route::controller(BuildingController::class)->name('buildings.')->group(function () {
    Route::post('buildings/image/{building}', [BuildingController::class, 'store_image'])->name('store_image');
    Route::delete('buildings/image/{image}', [BuildingController::class, 'destory_image'])->name('destory_image');

    Route::patch('buildings/assign/{building}', [BuildingController::class, 'assign'])->name('assign');
    Route::patch('buildings/unassign/{building}', [BuildingController::class, 'unassign'])->name('unassign');
});

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
