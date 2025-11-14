<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminChangedUsername;

class LogAdminChangingUsername
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
    public function handle(AdminChangedUsername $event): void
    {
        $admin = $event->admin;
        $user_to_change = $event->user_to_change;
        $old_username = $event->old_username;
        $new_username = $event->new_username;

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
            ->withProperties([
                'admin' => $admin->username,
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log("Admin has changed user's username.");
    }
}
