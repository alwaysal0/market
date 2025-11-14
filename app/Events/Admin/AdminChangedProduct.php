<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Product;
use App\Models\User;

class AdminChangedProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $admin;
    public Product $product;
    /**
     * Create a new event instance.
     */
    public function __construct(User $admin, Product $product)
    {
        $this->admin = $admin;
        $this->product = $product;
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
