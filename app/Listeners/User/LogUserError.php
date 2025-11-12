<?php

namespace App\Listeners\User;

use App\Events\User\UserError;

class LogUserError
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
    public function handle(UserError $event): void
    {
        $user = $event->user;
        $content = $event->content;
        activity('user-error')
            ->causedBy($user)
        ->log($content);
    }
}
