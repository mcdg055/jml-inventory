<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplies\StoreSupplyRequest;
use App\Http\Resources\SupplyResource;
use App\Models\Supplier;
use App\Models\Supply;
use App\Services\SupplyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

use function PHPUnit\Framework\throwException;

class SuppliesController extends Controller
{

    protected SupplierController $supplierController;
    protected Supply $model;
    protected SupplyService $service;

    public function __construct(SupplyService $service, SupplierController $supplierController, Supply $supply)
    {
        $this->supplierController = $supplierController;
        $this->model = $supply;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        return Inertia::render("Supplies/SuppliesScreen");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['suppliers'] = $this->supplierController->getSuppliers();

        return Inertia::render("Supplies/AddSupplyScreen", $data);
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

        return new SupplyResource($this->service->add($inputs));
    }

    function syncRelations($data, Supply $supply)
    {
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
