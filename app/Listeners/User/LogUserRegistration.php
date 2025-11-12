<?php

namespace App\Listeners\User;

use App\Events\User\UserRegistered;

class LogUserRegistration
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
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        activity('auth')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'email' => $user->email,
            ])
        ->log('New user has been registered');
    }
}
