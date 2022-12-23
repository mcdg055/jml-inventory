<?php

namespace App\Services;

use App\Models\Supply;
use App\Models\SupplyItem;
use App\Repositories\SupplyRepository;
use Illuminate\Http\Request;

class SupplyService
{
    protected SupplyRepository $repository;

    public function __construct(SupplyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function browse($data, $limit)
    {
        $supplies = $this->repository->browse($data, $limit);

        $supplies->load(['supplier', 'receiver', 'supply_items', 'supply_items.inventory_item']);

        return $supplies;
    }

    public function read($data, Supply $supply)
    {
        $supply->load([
            'supplier',
            'supply_items',
            'supply_items.inventory_item'
        ]);
        return $supply;
    }

    public function edit(Request $request, Supply $supply)
    {
    }
    public function add($data)
    {
        $supply = $this->repository->insert($data);

        return $supply;
    }

    public function updateSupplyDetails($data, $supply)
    {
        return $this->repository->updateSupplyDetails($data, $supply);
    }

    public function delete(Request $request, Supply $supply)
    {
    }

    public function readSupplyItem(array $data, SupplyItem $supply_item)
    {
        $supply_item->load(['inventory_item']);

        return $supply_item;
    }

    public function updateSupplyItemQuantity(array $data, SupplyItem $supply_item)
    {
        if ($this->repository->updateSupplyItemQuantity($data, $supply_item)) {
            return ['success' => 'Supply item was successfully updated!'];
        }

        return ['error' => 'Unable to update supply item'];
    }

    public function deleteSupplyitem(SupplyItem $supply_item)
    {
        if ($this->repository->deleteSupplyitem($supply_item)) {
            return ['success' => 'Supply item was successfully deleted!'];
        }

        return ['error' => 'Unable to delete supply item'];
    }
}
