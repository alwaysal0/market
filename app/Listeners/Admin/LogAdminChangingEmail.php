<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminChangedEmail;

class LogAdminChangingEmail
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
    public function handle(AdminChangedEmail $event): void
    {
        $admin = $event->admin;
        $user_to_change = $event->user_to_change;
        $old_email = $event->old_email;
        $new_email = $event->new_email;

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
            ->withProperties([
                'admin' => $admin->username,
                'user_to_change' => $user_to_change->username,
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
        ->log("Admin has changed user's email.");
    }
}
