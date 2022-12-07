<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplies\StoreSupplyRequest;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplyResource;
use App\Models\Supplier;
use App\Models\Supply;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

use function PHPUnit\Framework\throwException;

class SupplyController extends Controller
{

    protected SupplierController $supplierController;
    protected Supply $model;

    public function __construct(SupplierController $supplierController, Supply $supply)
    {
        $this->supplierController = $supplierController;
        $this->model = $supply;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Inertia::render("Supplies/SuppliesScreen", ['suppliers' => $this->supplierController->getSuppliers()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplyRequest $request)
    {
        $inputs = $request->validated();

        $supply = $this->model->fill($inputs);

        $supply = $this->fillRelations($inputs, $supply);

        try {
            $supply->save();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
        return new SupplyResource($supply);
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
