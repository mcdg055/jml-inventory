<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassOutRequest;
use App\Models\InventoryItem;
use App\Models\PassOut;
use App\Models\PassOutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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
            $this->inventoryItemsController->decreaseStock($validated);
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
        $data = [
            'item' => $pass_out
        ];
        return Inertia::render("PassOuts/PassOutScreen", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editPassOutItem(Request $request, PassOutItem $pass_out_item)
    {
        return $pass_out_item;
    }
}
