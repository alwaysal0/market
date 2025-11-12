<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserChangedUsername
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public String $old_username;
    public String $new_username;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $old_username, string $new_username)
    {
        $this->user = $user;
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
