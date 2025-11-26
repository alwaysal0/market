<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class AdminRepliedReport
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public string $user_id;
    public User $admin;
    public string $report_id;
    public string $response_id;
    public function __construct(string $user_id, User $admin, string $report_id, string $response_id)
    {
        $this->user_id = $user_id;
        $this->admin = $admin;
        $this->report_id = $report_id;
        $this->response_id = $response_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
