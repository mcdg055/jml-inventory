<?php

namespace App\Listeners;

use Illuminate\Support\Arr;
use App\Events\SupplyItemEvent;
use App\Repositories\InventoryItemRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupplyItemUpdated
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
     * @param  \App\Events\SupplyItemEvent  $event
     * @return void
     */
    public function handle(SupplyItemEvent $event)
    {
        $this->updateInventoryItemStock($event->data, $event->supply_item);
    }

    public function updateInventoryItemStock($data, $supply_item)
    {
        if ($quantity = Arr::get($data, 'quantity')) {

            $new_stock = $quantity - $supply_item->quantity;
            
            if ($new_stock > 0) {
                $this->inventory_item_repository->increaseStock($new_stock, $supply_item->inventory_item);
            } else {
                $this->inventory_item_repository->decreaseStock(abs($new_stock), $supply_item->inventory_item);
            }
        }
    }
}
