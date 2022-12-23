<?php

namespace App\Listeners\Supply;

use App\Events\Supply\SupplyItemDeletedEvent;
use App\Repositories\InventoryItemRepository;

class SupplyItemDeletedListener
{
    private InventoryItemRepository $inventory_item_repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(InventoryItemRepository $inventory_item_repository)
    {
        $this->inventory_item_repository = $inventory_item_repository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SupplyItemDeletedEvent  $event
     * @return void
     */
    public function handle(SupplyItemDeletedEvent $event)
    {
        $this->updateInventoryItemStock($event->supply_item);
    }

    /**
     * decrease the stock of the inventory item
     *
     * @param Object $supply_item
     * @return void
     */
    public function updateInventoryItemStock($supply_item)
    {
        $this->inventory_item_repository->decreaseStock($supply_item->quantity, $supply_item->inventory_item);
    }
}
