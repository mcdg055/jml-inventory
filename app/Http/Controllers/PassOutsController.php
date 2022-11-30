<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassOutRequest;
use App\Http\Requests\UpdatePassOutDetailsRequest;
use App\Http\Requests\UpdatePassOutItemRequest;
use App\Http\Resources\PassOutItemResource;
use App\Http\Resources\PassOutResource;
use App\Models\InventoryItem;
use App\Models\PassOut;
use App\Models\PassOutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PassOutsController extends Controller
{
    protected PassOut $model;
    protected PassOutItem $passOutItems;
    protected InventoryItemsController $inventoryItemsController;
    public function __construct(PassOut $model, PassOutItem $passOutItems, InventoryItemsController $inventoryItemsController)
    {
        $this->model = $model;
        $this->passOutItems = $passOutItems;
        $this->inventoryItemsController = $inventoryItemsController;
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
        $pass_outs = $this->model->query()
            ->with([])
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        $filters = ['search' => $search_input];

        $data = [
            'pass_outs' => $pass_outs,
            'filters' => $filters,
        ];


        return Inertia::render('PassOuts/PassOutsScreen',  $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inputs = $request->all();
        $data = $this->fillData($inputs);

        return Inertia::render('PassOuts/widgets/AddPassOut', $data);
    }

    public function fillData($inputs)
    {

        $search_input = "";
        $selected = [];

        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }

        if (isset($inputs["selected"]) && count($inputs['selected']) > 0) {
            foreach ($inputs["selected"] as $key => $value) {
                $selected[] = $inputs['selected'][$key]['id'];
            }
        }

        $inventory_items = InventoryItem::query()
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->with([
                'brand' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->whereNotIn('id', $selected)
            ->where('stock', '>', 0)
            ->limit(3)
            ->get();

        return $inventory_items;
    }

    public function getInventoryItems(Request $request)
    {
        $inputs = $request->all();

        return $this->fillData($inputs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePassOutRequest $request)
    {
        $validated = $request->validated();

        try {

            $this->model->fill($validated);

            $passOut = $this->model->save();

            $this->insertPassOutItems($passOut, $validated);

            $this->inventoryItemsController->decreaseMultipleStock($validated);
        } catch (\Throwable $th) {
            return [
                "error" => $th->getMessage(),
            ];
        }

        return [
            "success" => "Pass out created successfully!",
        ];
    }

    public function insertPassOutItems($id, $data)
    {
        $data = $this->proccessPassOutItems($id, $data);

        return $this->passOutItems->insert($data);
    }

    public function proccessPassOutItems($id, $data)
    {
        $item_collection = [];

        if ($selected_items = $data['selected_items']) {
            foreach ($selected_items as $key => $value) {

                array_push($item_collection, [
                    'item_id' => $value['id'],
                    'quantity' => $value['quantity'],
                    'pass_out_id' => $this->model->id,
                    'subtotal' => $value['quantity'] * $value['unit_price'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        return $item_collection;
    }

    public function redirectToBrowse(Request $request)
    {
        return Redirect::route("pass-outs.browse")->with('success', "Pass out created successfully!");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request, PassOut $pass_out)
    {
        $message = [];
        $data = $request->all();
        if (isset($data['success'])) {

            $message['success'] = $data["success"];
        }
        return Inertia::render("PassOuts/PassOutScreen", ['pass_out' => new PassOutResource($pass_out)])->with($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PassOut $pass_out)
    {
        return new PassOutResource($pass_out);
    }

    /**
     * Update Pass Out details
     *
     * @param Request $request
     * @param PassOut $pass_out
     * @return void
     */
    public function update(UpdatePassOutDetailsRequest $request, PassOut $pass_out)
    {
        $data = $request->validated();

        $pass_out->fill($data);

        try {
            $pass_out->save();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

        return new PassOutResource($pass_out);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PassOut $pass_out)
    {
        try {
            $pass_out->delete();
        } catch (\Throwable $th) {
            return Redirect::route("pass-outs.browse")->with('error', $th->getMessage());
        }

        return Redirect::route("pass-outs.browse")->with('success', "Pass out successfully deleted!");
    }

    public function readPassOutItem(Request $request, PassOutItem $pass_out_item)
    {
        $pass_out_item->load('inventory_item');

        return new PassOutItemResource($pass_out_item);
    }

    public function updatePassOutItem(UpdatePassOutItemRequest $request, PassOut $pass_out, PassOutItem $pass_out_item)
    {
        $data = $request->validated();

        try {
            $inventory_item = $this->updateInventoryItemStock($data['quantity'], $pass_out_item);

            $pass_out_item = $this->calculateNewQuantity($data['quantity'], $pass_out_item);

            $pass_out_item->save();
        } catch (\Throwable $th) {
            return [
                "error" => $th->getMessage(),
            ];
        }

        $items = $pass_out->items;
        $items->load('inventory_item');

        return PassOutItemResource::collection($items);
    }

    /**
     * Calculate the new quantity
     *
     * @param int $newQuantity
     * @param PassOutItem $pass_out_item
     * @return PassOutItem
     */
    public function calculateNewQuantity($newQuantity, PassOutItem $pass_out_item)
    {
        $pass_out_item->quantity = $newQuantity;
        $pass_out_item->subtotal = $newQuantity * $pass_out_item->inventory_item->unit_price;

        return $pass_out_item;
    }

    public function updateInventoryItemStock($newQuantity, PassOutItem $pass_out_item)
    {
        $oldQuantity = $pass_out_item->quantity;

        if ($oldQuantity > $newQuantity) {
            $difference = $oldQuantity - $newQuantity;
            $inventory_item = $this->inventoryItemsController->increaseStock($difference, $pass_out_item->inventory_item);
        } else {
            $difference = $newQuantity - $oldQuantity;
            $inventory_item = $this->inventoryItemsController->decreaseStock($difference, $pass_out_item->inventory_item);
        }

        return $inventory_item;
    }

    public function readPassOutItems(Request $request, PassOut $pass_out)
    {
        $pass_out->load('items', 'items.inventory_item');

        $pass_out_items = $pass_out->items;

        return PassOutItemResource::collection($pass_out_items);
    }

    public function deletePassOutItem(Request $request, PassOutItem $pass_out_item)
    {
        try {
            $pass_out_item->delete();
            $this->inventoryItemsController->increaseStock($pass_out_item->quantity, $pass_out_item->inventory_item);
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

        return ['success' => "Item successfully deleted from the pass out"];
    }

    public function browsePassOutItems(Request $request, PassOut $pass_out)
    {
        $search = "";

        if ($request->search) {
            $search = $request->search;
        }
        $id = $pass_out->getKey();
        $pass_out_items = PassOutItem::where('pass_out_id', $pass_out->getKey())
            ->with([
                'inventory_item',
                'inventory_item.brand',
            ])
            ->whereHas('inventory_item', function ($query) use ($search) {
                $query->where('name', "LIKE", "%$search%")
                    ->with('brand')
                    ->orWhereHas('brand', function ($query) use ($search) {
                        $query->where('name', "LIKE", "%$search%");
                    });
            })
            ->get();

        return PassOutItemResource::collection($pass_out_items);
    }
}
