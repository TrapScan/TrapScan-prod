<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\InspectionController;
use \App\Http\Controllers\OtherAuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\ProjectsController;

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

Route::get('/anon/{qr_id?}', function ($qr_id = null) {
    return Inertia::render('Index',['qr_id'=>$qr_id]);
})->name('index');

Route::get('/ui', function () {
    return Inertia::render('UIElements');
})->name('ui');

Route::get('/anon/scan/{qr_id?}',[InspectionController::class,'anon_index'])->name('anon_form');

Route::get('/anon_success', function () {
    return Inertia::render('AnonscanDone');
})->name('anon_success');

Route::post('/anon', [InspectionController::class, 'createAnon'])->name('anon_form.store');

Route::get('/scan', function () {
    return Inertia::render('Main');
})->middleware(['auth', 'verified'])->name('scan');

Route::get('/find_by_qr', function () {
    return Inertia::render('FindByQr');
})->middleware(['auth', 'verified'])->name('find_by_qr');



Route::get('/install_qr/{trap_id}', function ($trap_id) {
    return Inertia::render('RemapQR',['trap_id' => $trap_id,'type' => 'install_qr','user' => \Auth::id()]);
})->middleware(['auth', 'verified'])->name('install_qr');

Route::get('/scan/{qr_id?}',[InspectionController::class,'index'])
    ->name('inspection.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return Inertia::render('About');
})->middleware(['auth', 'verified'])->name('about');

Route::group(['middleware'=>['auth', 'verified'], 'prefix'=>'inspection'],function() {
    Route::get('/inspection_add',[InspectionController::class,'inspection_add'])->name('inspection.inspection_add');
    Route::post('/save',[InspectionController::class, 'save'])->name('inspection.save');
    Route::post('/map_trap',[ProjectsController::class, 'map_trap'])->name('inspection.map_trap');
    Route::get('/map_trap', function(){
        return back();
    });
    Route::get('/remove_qr/{trap_id}', [ProjectsController::class, 'remove_qr'])->middleware(['auth', 'verified'])->name('remove_qr');
    Route::get('/remove_qr_confirmed/{trap_id}', [ProjectsController::class, 'remove_qr_confirmed'])->middleware(['auth', 'verified'])->name('remove_qr_confirmed');
});

Route::group(['middleware'=>['auth', 'verified'], 'prefix'=>'user'],  function() {
    Route::get('/stat/',[UserController::class,'userStat'])->name('user.index');
    Route::get('projects',[ProjectsController::class, 'projects'])->name('user.projects');
    Route::get('project/view/{id}',[ProjectsController::class, 'view'])->name('user.projects.view');
    Route::get('settings',[UserController::class, 'settings'])->name('user.settings');

    Route::post('project/leave',[ProjectsController::class, 'leave'])->name('user.projects.leave');
    Route::post('project/enter',[ProjectsController::class, 'enter'])->name('user.projects.enter');
    Route::put('project/update_user',[ProjectsController::class, 'updateUserSettings'])->name('user.projects.update_user');

    Route::post('project/sync',[ProjectsController::class, 'updateProjectTraps'])->name('user.projects.sync');
});

Route::group(['middleware'=>['auth', 'verified','role:admin'], 'prefix'=>'admin'],  function() {
    Route::get('/',[AdminController::class, 'index'])->name('admin.index');
    //QR
    Route::post('/generate_qr',[AdminController::class, 'generate_qr'])->name('admin.save');
    Route::get('/unmapped_codes',[AdminController::class, 'unmapped_codes'])->name('admin.unmapped_codes');

    Route::get('/unmapped_traps',[AdminController::class, 'unmapped_traps'])->name('admin.unmapped_traps');
    Route::post('/map_trap',[AdminController::class, 'map_trap'])->name('admin.map_trap');
    Route::get('/all_traps',[AdminController::class, 'all_traps'])->name('admin.all_traps');

    Route::get('/users',[AdminController::class, 'users'])->name('admin.users');
    Route::post('/remove_from_pr',[AdminController::class, 'remove_from_pr'])->name('admin.remove_from_pr');
    Route::post('/add_to_pr',[AdminController::class, 'add_to_pr'])->name('admin.add_to_pr');
    Route::put('/update_user_pr_settingsr',[AdminController::class, 'updateProjectUser'])->name('admin.update_user_pr_settingsr');

    Route::get('/scrape_data',function () {
        return Inertia::render('Admin/Scrap');
    })->name('admin.scrape_data');

    Route::get('start_scrap', [AdminController::class, 'start_scrap'])->name('admin.start_scrap');
});

require __DIR__.'/auth.php';
