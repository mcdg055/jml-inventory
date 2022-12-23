<?php

namespace App\Events\Supply;

use App\Models\SupplyItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupplyItemDeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Supply Item Model
     *
     * @var SupplyItem
     */
    public SupplyItem $supply_item;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SupplyItem $supply_item)
    {
        $this->supply_item = $supply_item;
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
