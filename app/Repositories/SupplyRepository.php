<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\InventoryItem;
use App\Models\Supplier;
use App\Models\Supply;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class SupplyRepository
{
    protected Supply $model;

    public function __construct(Supply $model)
    {
        $this->model =  $model;
    }

    public function browse($inputs)
    {
    }

    public function read(Request $request, Brand $brand)
    {
    }
    public function insert($data)
    {
        $supply = $this->model->fill($data);

        $supply = $this->fillRelations($data, $supply);

        try {
            $supply->save();
            $this->syncRelations($data, $supply);
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

    function syncRelations($data, Supply $supply)
    {
        if ($items = Arr::get($data, 'items')) {
            foreach ($items as $key => $value) {
                $item = InventoryItem::findOrFail($value['id']);
                $items[$key]['unit_price'] = $item->unit_price;
                $items[$key]['item_id'] = $item->id;
                unset($items[$key]['id']);
            }

            $supply->items()->sync($items);
        }
    }
}
