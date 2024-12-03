<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'guest'])->name('/');
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Admin route
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('adm')->name('adm.')->group(function(){
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('org', App\Http\Controllers\base\OrganizationController::class);
        Route::resource('menu', App\Http\Controllers\MenuController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('sub-menu', App\Http\Controllers\SubMenuController::class);
        Route::resource('jenis', App\Http\Controllers\JenisController::class);
        Route::resource('kategori', App\Http\Controllers\KategoriController::class);
        Route::resource('person', App\Http\Controllers\base\PersonController::class);
        Route::resource('provinsi', App\Http\Controllers\ProvinsiController::class);
    });
});

//Api datatable
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('api')->name('api.')->group(function(){
        Route::get('org/data', [App\Http\Controllers\base\OrganizationController::class, 'getData'])->name('org.data');
        Route::get('menu/sub/{id}', [App\Http\Controllers\MenuController::class, 'getSub'])->name('menu.sub');
        Route::get('menu/by-id/{id}', [App\Http\Controllers\MenuController::class, 'getMenuByID'])->name('menu.by-id');
        Route::get('jenis/by-id/{id}', [App\Http\Controllers\JenisController::class, 'getByID'])->name('jenis.by-id');
        Route::get('jenis/all', [App\Http\Controllers\JenisController::class, 'all'])->name('jenis.all');
        Route::get('kategori/by-id/{id}', [App\Http\Controllers\KategoriController::class, 'getByID'])->name('jenis.by-id');

        //roles
        Route::get('roles/{id}/edits', [App\Http\Controllers\RoleController::class, 'editRole'])->name('roles.editRole');
        Route::post('roles/updates', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('roles.updateRole');
    });
});

// for manual login
Route::get('register', [App\Http\Controllers\auth\AuthController::class, 'reg'])->name('register');
Route::post('register', [App\Http\Controllers\auth\AuthController::class, 'register'])->name('register');
Route::get('login', [App\Http\Controllers\auth\AuthController::class, 'logview'])->name('login');
Route::post('signin', [App\Http\Controllers\auth\AuthController::class, 'login'])->name('signin');
Route::post('authenticating', [App\Http\Controllers\auth\AuthController::class, 'login'])->name('authenticating');
Route::post('logout', [App\Http\Controllers\auth\AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
Route::get('me', [App\Http\Controllers\auth\AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('admin/roles/{role}/permissions/{module}', [App\Http\Controllers\RoleController::class, 'updatePermissionAccess']);

use App\Http\Controllers\PermissionController;

// Route untuk halaman index permissions
Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

// Route untuk halaman edit permission
Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');

// Route untuk menyimpan perubahan permission
Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');

// Route untuk menambah permission
Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
