<?php

namespace App\Listeners\User;

use App\Events\User\UserSentReview;

class LogUserSendingReview
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
    public function handle(UserSentReview $event): void
    {
        $user = $event->user;
        $message = $event->message;
        activity('user')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'message' => $message,
            ])
        ->log('Sent the review.');
    }
}
