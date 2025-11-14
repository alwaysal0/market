<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class AdminChangedUsername
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $admin;
    public User $user_to_change;
    public string $new_username;
    public string $old_username;
    /**
     * Create a new event instance.
     */
    public function __construct(User $admin, User $user_to_change, string $old_username, string $new_username)
    {
        $this->admin = $admin;
        $this->user_to_change = $user_to_change;
        $this->old_username = $old_username;
        $this->new_username = $new_username;
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
