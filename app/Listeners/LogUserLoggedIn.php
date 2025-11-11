<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLoggedIn
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
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;
        activity('auth')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'email' => $user->email,
            ])
        ->log('The user has loggined');
    }
}
