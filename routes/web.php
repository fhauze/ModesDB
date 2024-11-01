<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'guest'])->name('/');
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('adm')->name('adm.')->group(function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('org', App\Http\Controllers\base\OrganizationController::class);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('api')->name('api.')->group(function(){
        Route::get('org/data', [App\Http\Controllers\base\OrganizationController::class, 'getData'])->name('org.data');
    });
});

// for manual login
Route::get('register', [App\Http\Controllers\auth\AuthController::class, 'reg'])->name('register');
Route::post('register', [App\Http\Controllers\auth\AuthController::class, 'register'])->name('register');
Route::get('login', [App\Http\Controllers\auth\AuthController::class, 'logview'])->name('login');
Route::post('signin', [App\Http\Controllers\auth\AuthController::class, 'login'])->name('signin');
Route::post('authenticating', [App\Http\Controllers\auth\AuthController::class, 'login'])->name('authenticating');
Route::post('logout', [App\Http\Controllers\auth\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [App\Http\Controllers\auth\AuthController::class, 'me'])->middleware('auth:sanctum');