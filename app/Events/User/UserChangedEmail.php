<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserChangedEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public String $new_email;
    public string $old_email;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, String $old_email, String $new_email)
    {
        $this->user = $user;
        $this->new_email = $new_email;
        $this->old_email = $old_email;
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
