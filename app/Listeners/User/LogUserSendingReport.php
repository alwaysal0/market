<?php

namespace App\Listeners\User;

use App\Events\User\UserSentReport;

class LogUserSendingReport
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
    public function handle(UserSentReport $event): void
    {
        $user = $event->user;
        $content = $event->content;
        activity('user')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'content' => $content,
            ])
        ->log('Sent the report.');
    }
}
