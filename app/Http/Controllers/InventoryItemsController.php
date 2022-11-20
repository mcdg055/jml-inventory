<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryItem\AddStockRequest;
use App\Http\Requests\StoreInventoryItemRequest;
use App\Models\Brand;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InventoryItemsController extends Controller
{
    private InventoryItem $model;

    public function __construct()
    {
        $this->model = new InventoryItem();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();

        $search_input = "";

        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }
        $inventory_items = $this->model->query()
            ->with([
                'brand' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        $filters = ['search' => $search_input];

        $data = [
            'inventory_items' => $inventory_items,
            'filters' => $filters,
        ];

        return inertia::render("InventoryItems/InventoryItemsScreen", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::select('id', 'name')->get();

        return inertia::render("InventoryItems/widgets/AddInventoryItem", ['brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryItemRequest $request)
    {
        $data = $request->validated();

        try {
            $this->model->fill($data);
            $this->model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Unable to add data");
        }

        return Redirect::route("inventory-items.browse")->with('success', 'Successfully added a new item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, InventoryItem $inventory_item)
    {
        if ($inventory_item->id) {

            $inventory_item['brand'] = $inventory_item->brand;

            return inertia::render('InventoryItems/widgets/AddStock', ['item' => $inventory_item]);
        }

        return redirect()->back()->with('error', 'Item cannot be found!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, InventoryItem $inventory_item)
    {
        if ($inventory_item->id) {

            //fetch relation data
            $inventory_item['brand'] = $inventory_item->brand;

            //fetch all brands
            $brands = Brand::select('id', 'name')->get();

            //return and pass all required data as props
            return inertia::render('InventoryItems/widgets/EditInventoryItem', [
                'item' => $inventory_item,
                'brands' => $brands,
            ]);
        }

        return redirect()->back()->with('error', "Unable to fetch inventory item details");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInventoryItemRequest $request, InventoryItem $inventory_item)
    {
        $data = $request->validated();

        try {
            $inventory_item->fill($data);
            $inventory_item->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Unable to update item');
        }

        return Redirect::route("inventory-items.browse")->with('success', 'Item was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryItem $inventory_item)
    {
        try {
            $inventory_item->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Unable to delete the item');
        }

        return Redirect::route("inventory-items.browse")->with('success', "The item was succesfully deleted");
    }

    public function addStock(AddStockRequest $request, InventoryItem $inventory_item)
    {
        $data = $request->validated();

        $stock = $data['stock'];

        $stock += $inventory_item->stock;
        try {
            $inventory_item->stock = $stock;
            $inventory_item->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Unable to add item stock');
        }

        return Redirect::route("inventory-items.browse")->with('success', "The item was succesfully updated");
    }
}
