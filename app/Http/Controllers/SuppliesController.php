<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplies\StoreSupplyRequest;
use App\Http\Resources\SupplyResource;
use App\Models\Supply;
use App\Services\SupplyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $inputs = $request->all();
        $data = [];
        if ($flash = Arr::get($inputs, "flash")) {
            $data['flash'] = $flash;
        }

        return Inertia::render("Supplies/SuppliesScreen", $data);
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

    public function show(Request $request, Supply $supply)
    {
        $supply = $this->service->read($request->all(), $supply);

        return Inertia::render("Supplies/SupplyScreen", ['supply' => new SupplyResource($supply)]);
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
