<?php

namespace App\Repositories;

use App\Models\InventoryItem;
use Illuminate\Support\Facades\Request;

class InventoryItemRepository
{
    protected InventoryItem $model;

    public function __construct(InventoryItem $model)
    {
        $this->model = $model;
    }

    public function browse($inputs)
    {

        $search_input = "";
        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }
        $brands = $this->model->query()
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($inventory_item) => [
                'id' => $inventory_item->id,
                'name' => $inventory_item->name
            ]);

        $filters = ['search' => $search_input];

        $data = [
            'brands' => $brands,
            'filters' => $filters,
        ];

        return $data;
    }

    public function read(Request $request, InventoryItem $inventory_item)
    {
    }
    public function add($data)
    {
        
    }

    public function edit(Request $request, InventoryItem $inventory_item)
    {
    }

    public function update(array $data, InventoryItem $inventory_item)
    {
    }

    public function delete(Request $request, InventoryItem $inventory_item)
    {
    }

    public function increaseStock($new_stock, InventoryItem $inventory_item)
    {
        $new_stock += $inventory_item->stock;

        $inventory_item->stock = $new_stock;

        return $this->updateInventoryStock($inventory_item);
    }

    public function decreaseStock($quantity_used, InventoryItem $inventory_item)
    {
        $stock = $inventory_item->stock;
        $inventory_item->stock = $stock - $quantity_used;

        return $this->updateInventoryStock($inventory_item);
    }

    public function updateInventoryStock(InventoryItem $inventory_item)
    {
        try {
            return $inventory_item->save();
        } catch (\Throwable $th) {
            return ["error" => $th->getMessage()];
        }
    }
}
