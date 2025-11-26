<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminRepliedReport;

class LogAdminReplyingReport
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
    public function handle(AdminRepliedReport $event): void
    {
        $admin = $event->admin;
        $user_id = $event->user_id;
        $report_id = $event->report_id;
        $response_id = $event->response_id;

        activity('admin')
            ->causedBy($admin)
            ->withProperties([
                'admin' => $admin->username,
                'admin_id' => $admin->id,
                'user_id' => $user_id,
                'report_id' => $report_id,
                'response_id' => $response_id,
            ])
        ->log("Admin has replied to user's report.");
    }
}
