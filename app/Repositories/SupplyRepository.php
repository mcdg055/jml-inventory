<?php

namespace App\Repositories;

use App\Http\Controllers\InventoryItemsController;
use App\Models\Brand;
use App\Models\InventoryItem;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\SupplyItem;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class SupplyRepository
{
    protected Supply $model;

    /**
     * @var InventoryItemsController
     */
    protected InventoryItemsController $inventoryItemController;

    /**
     * @var InventoryItemRepository
     */
    protected InventoryItemRepository $inventoryItemRepository;

    /**
     * @param Supply $model
     * @param InventoryItemsController $inventoryItemController
     * @param InventoryItemRepository $inventoryItemRepository
     */
    public function __construct(Supply $model, InventoryItemsController $inventoryItemController, InventoryItemRepository $inventoryItemRepository)
    {
        $this->model =  $model;
        $this->inventoryItemController = $inventoryItemController;
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    /**
     * used to browse supplies
     *
     * @param array $inputs
     * 
     * @return Supply|collection
     */
    public function browse($inputs)
    {
        $search_input = "";

        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }

        $supplies = $this->model->query()
            ->when($search_input, function ($query, $search) {
                //$query->where('name', 'like', "%{$search}%");
            })
            ->get();
        return $supplies;
    }

    public function read(array $data, Supply $supply)
    {
    }

    /**
     * used for inserting a supply
     * 
     * @param array $data
     * 
     * @return return Supply
     */
    public function insert($data)
    {
        $supply = $this->model->fill($data);

        $supply = $this->fillRelations($data, $supply);

        try {
            $supply->save();
            $supply = $this->syncRelations($data, $supply);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
        }
        return $supply;
    }

    public function edit(Request $request, Brand $brand)
    {
    }

    public function update($brand, $data)
    {
    }

    public function delete(Request $request, Brand $brand)
    {
    }

    /**
     * Updating item quantity of a supply
     *
     * @param array $data
     * @param SupplyItem $supply_item
     * 
     * @return bool
     */
    function updateSupplyItemQuantity($data, SupplyItem $supply_item)
    {
        if ($quantity = Arr::get($data, 'quantity')) {
            $supply_item->quantity = $quantity;
        }

        try {
            $this->updateInventoryItemStock($data, $supply_item);

            $supply_item->save();
            return true;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
        }

        return false;
    }

    /**
     * Deleting a specific supply item
     *
     * @param SupplyItem $supply_item
     * @return void
     */
    public function deleteSupplyitem(SupplyItem $supply_item)
    {
        try {
            return $supply_item->delete();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
        }

        return false;
    }

    public function updateInventoryItemStock($data, $supply_item)
    {
        if ($quantity = Arr::get($data, 'quantity')) {

            $new_stock = $quantity->$supply_item->quantity;
            if ($new_stock > 0) {
                $this->inventoryItemRepository->increaseStock($new_stock, $supply_item->inventory_item_id);
            } else {
                $this->inventoryItemRepository->decreaseStock(abs($new_stock), $supply_item->inventory_item_id);
            }
        }
    }

    /**
     * fill the relations needed to complete the process of adding a supply
     *
     * @param array $data
     * @param Supply $supply
     * @return Supply
     */
    function fillRelations($data, Supply $supply)
    {
        if ($supplier_id = Arr::get($data, 'supplier_id')) {
            $supplier = Supplier::findOrFail($supplier_id);

            $supply->supplier()->associate($supplier);
        }

        if ($user = auth()->user()) {
            $supply->receiver()->associate($user);
        }

        return $supply;
    }

    /**
     * @param array $data
     * @param Supply $supply
     * 
     * @return Supply
     */
    function syncRelations($data, Supply $supply)
    {
        if ($items = Arr::get($data, 'items')) {
            foreach ($items as $key => $value) {

                $item = InventoryItem::findOrFail($value['id']);

                $items[$key]['unit_price'] = $item->unit_price;
                $items[$key]['inventory_item_id'] = $item->id;

                unset($items[$key]['id']);

                $this->inventoryItemRepository->increaseStock($value['quantity'], $item);
            }

            $supply->items()->sync($items);
        }

        return $supply;
    }
}
