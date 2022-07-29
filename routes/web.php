<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\InspectionController;
use \App\Http\Controllers\OtherAuthController;
use \App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/magic-login', [OtherAuthController::class, 'sendLoginLink'])->name('magic_login');

Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');

Route::get('/anon', function () {
    return Inertia::render('Anonscan');
})->name('anon_form');

Route::get('/anon_success', function () {
    return Inertia::render('AnonscanDone');
})->name('anon_success');

Route::post('/anon', [InspectionController::class, 'createAnon'])->name('anon_form.store');

Route::get('/scan', function () {
    return Inertia::render('Main');
})->middleware(['auth', 'verified'])->name('scan');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return Inertia::render('About');
})->middleware(['auth', 'verified'])->name('about');

Route::group(['middleware'=>['auth', 'verified'], 'prefix'=>'inspection'],function() {
    Route::get('/inspect/{qr_id?}',[InspectionController::class,'index'])->name('inspection.index');
    Route::get('/inspection_add',[InspectionController::class,'inspection_add'])->name('inspection.inspection_add');
    Route::post('/save',[InspectionController::class, 'save'])->name('inspection.save');
});

Route::group(['middleware'=>['auth', 'verified'], 'prefix'=>'user'],  function() {
    Route::get('/stat/',[UserController::class,'userStat'])->name('user.index');
    Route::get('projects',[UserController::class, 'projects'])->name('user.projects');

    Route::get('settings',[UserController::class, 'settings'])->name('user.settings');
});


require __DIR__.'/auth.php';
