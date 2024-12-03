<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\CreateProfileForUser;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Tambahkan event dan listener Anda di sini
        // Contoh:
        // 'App\Events\SomeEvent' => [
        //     'App\Listeners\SomeListener',
        // ],
        Registered::class => [
            CreateProfileForUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
