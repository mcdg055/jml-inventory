<?php

namespace App\Events;

use App\Models\SupplyItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SupplyItemEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var SupplyItem
     */
    public SupplyItem $supply_item;

    /**
     * @var Array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SupplyItem $supply_item, $data)
    {
        $this->supply_item = $supply_item;
        $this->data = $data;
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
