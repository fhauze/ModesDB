<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
// use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        require_once app_path('Helpers/Helpers.php');
        User::observe(UserObserver::class);
    }
}
