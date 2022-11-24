<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassOutRequest;
use App\Models\InventoryItem;
use App\Models\PassOut;
use App\Models\PassOutItems;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PassOutsController extends Controller
{
    protected PassOut $model;
    protected PassOutItems $passOutItems;
    public function __construct(PassOut $model, PassOutItems $passOutItems)
    {
        $this->model = $model;
        $this->passOutItems = $passOutItems;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('PassOuts/PassOutsScreen');
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
        $item_id_collection = [];
        if ($selected_items = $data['selected_items']) {
            foreach ($selected_items as $key => $value) {

                array_push($item_id_collection, [
                    'item_id' => $value['id'],
                    'quantity' => $value['quantity'],
                    'pass_out_id' => $this->model->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        return $item_id_collection;
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
    public function show($id)
    {
        //
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
}
