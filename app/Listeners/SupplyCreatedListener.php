<?php

namespace App\Listeners;

use App\Events\SupplyEvent;
use App\Models\SupplyItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SupplyCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SupplyItem $supply_item)
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SupplyEvent  $event
     * @return void
     */
    public function handle(SupplyEvent $event)
    {
        dd($event->supply_item);
    }
}
