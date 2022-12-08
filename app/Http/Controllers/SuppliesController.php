<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplies\StoreSupplyRequest;
use App\Http\Resources\SupplyResource;
use App\Services\SupplyService;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuppliesController extends Controller
{
    protected SupplierController $supplierController;
    protected SupplyService $service;

    public function __construct(SupplyService $service, SupplierController $supplierController)
    {
        $this->supplierController = $supplierController;
      
        $this->service = $service;
    }


    public function index(Request $request)
    {
        return Inertia::render("Supplies/SuppliesScreen");
    }

    public function browse(Request $request)
    {

        $inputs = $request->all();

        $supplies = $this->service->browse($inputs);

        return SupplyResource::collection($supplies);
    }

    public function create(Request $request)
    {
        $data['suppliers'] = $this->supplierController->getSuppliers();

        return Inertia::render("Supplies/AddSupplyScreen", $data);
    }

    public function store(StoreSupplyRequest $request)
    {
        $inputs = $request->validated();

        return new SupplyResource($this->service->add($inputs));
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
