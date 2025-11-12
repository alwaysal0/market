<?php

namespace App\Listeners\User;

use App\Events\User\UserChangedUsername;

class LogUserChangingUsername
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
    public function handle(UserChangedUsername $event): void
    {
        $user = $event->user;
        $old_username = $event->old_username;
        $new_username = $event->new_username;
        activity('user')
            ->causedBy($user)
            ->withProperties([
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log('User has changed his username.');
    }
}
