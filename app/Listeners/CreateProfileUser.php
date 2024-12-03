<?php

namespace App\Listeners;

// use App\Events\Registered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Profile;
use App\Models\Person;

class CreateProfileUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            // Jangan buat profil saat seeder dijalankan
            return;
        }

        $user = $event->user;
        Person::create(['user_id' => $user->id]);
    }
}
