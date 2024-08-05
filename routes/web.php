<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomValidationController; 
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\SystemController;
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
    Route::get('/jobs', [JobController::class, 'publicIndex'])->name('jobs.publicIndex');

});
//hapa napo ni pa the -temporary debug statement to list the authenticated user's roles and permissions.
Route::get('/debug/permissions', function() {
    $user = auth()->user();
    return response()->json([
        'roles' => $user->roles->pluck('name'),
        'permissions' => $user->getAllPermissions()->pluck('name')
    ]);
});

 Route::middleware(['auth', 'superadmin'])->group(function () {
 Route::post('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    });

    // Route::middleware(['auth', 'check.active'])->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //     Route::get('/dashboard/products/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    //     Route::post('/dashboard/products', [DashboardController::class, 'storeProduct'])->name('dashboard.products.store');
    //     Route::get('/dashboard/roles/create', [DashboardController::class, 'createRole'])->name('dashboard.roles.create');
    //     Route::post('/dashboard/roles', [DashboardController::class, 'storeRole'])->name('dashboard.roles.store');
    // });
    

// Route::get('/admin', [AdminController::class, 'index'])
// ->middleware(['auth', 'check.active'])
// ->name('admin.index');

// Route::post('/update-profile', [ProfileController::class, 'update'])
// ->middleware(['auth', 'check.active'])
// ->name('profile.update');--if i want per individual but lets stick to the groupwise

// *reactivate user routes
Route::middleware(['auth', 'can:reactivate-user'])->group(function () {
    Route::post('/users/{user}/reactivate', [UserController::class, 'reactivate'])->name('users.reactivate');
});