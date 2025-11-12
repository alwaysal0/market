<?php

namespace App\Listeners\User;

use App\Events\User\UserChangedPassword;

class LogUserChangingPassword
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
    public function handle(UserChangedPassword $event): void
    {
        $user = $event->user;
        activity('user')
            ->causedBy($user)
        ->log('User has changed his password.');
    }
}
