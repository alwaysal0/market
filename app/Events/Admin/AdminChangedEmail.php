<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class AdminChangedEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $admin;
    public User $user_to_change;
    public string $old_email;
    public string $new_email;
    /**
     * Create a new event instance.
     */
    public function __construct(User $admin, User $user_to_change, string $old_email, string $new_email)
    {
        $this->admin = $admin;
        $this->user_to_change = $user_to_change;
        $this->old_email = $old_email;
        $this->new_email = $new_email;
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
