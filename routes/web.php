<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomValidationController; 

use App\Http\Controllers\JobController;

//customvalidation  
Route::get('custom-validation', [CustomValidationController::class, 'create']);
Route::post('custom-validation', [CustomValidationController::class, 'store'])->name('custom.validation.post');


Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    
});
Route::group(['middleware' => ['role:SuperAdmin']], function() {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/deactivate/{id}', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::put('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

});
    

Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/system-update', [AdminController::class, 'updateSystem'])->name('admin.updateSystem');
    Route::get('system/settings', [SystemSettingsController::class, 'index'])->name('system.settings');
    Route::post('system/settings', [SystemSettingsController::class, 'update'])->name('system.settings.update');

});
Route::group(['middleware' => ['auth', 'system-update']], function () {
    Route::get('/system/update', [SystemController::class, 'update'])->name('system.update');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('jobs', JobController::class);
});

