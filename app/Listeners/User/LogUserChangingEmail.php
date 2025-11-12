<?php

namespace App\Listeners\User;

use App\Events\User\UserChangedEmail;

class LogUserChangingEmail
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
    public function handle(UserChangedEmail $event): void
    {
        $user = $event->user;
        $old_email = $event->old_email;
        $new_email = $event->new_email;
        activity('user')
            ->causedBy($user)
            ->withProperties([
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
        ->log('User has changed his email.');
    }
}
