<?php

namespace App\Listeners\User;

use App\Events\User\UserLoggedIn;

class LogUserLoggedIn
{
    /**
     * Create the event listener.
     */
    public function __construct() {
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
