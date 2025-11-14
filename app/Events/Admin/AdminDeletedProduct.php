<?php

namespace App\Events\Admin;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class AdminDeletedProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $admin;
    public array $product_data;
    /**
     * Create a new event instance.
     */
    public function __construct(User $admin, array $product_data)
    {
        $this->admin = $admin;
        $this->product_data = $product_data;
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
