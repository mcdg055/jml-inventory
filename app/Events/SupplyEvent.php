<?php

namespace App\Events;

use App\Models\Supply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupplyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Supply $supply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Supply $supply)
    {
        $this->supply = $supply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
