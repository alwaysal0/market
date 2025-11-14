<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminChangedPassword;

class LogAdminChangingPassword
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
    public function handle(AdminChangedPassword $event): void
    {
        $admin = $event->admin;
        $user_to_change = $event->user_to_change;

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
            ->withProperties([
                'admin' => $admin->username,
                'user_to_change' => $user_to_change->username,
            ])
        ->log("Admin has changed user's password.");
    }
}
