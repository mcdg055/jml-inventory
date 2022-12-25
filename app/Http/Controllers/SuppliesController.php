<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Supply;
use PDF;
use App\Models\SupplyItem;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\SupplyService;
use App\Http\Traits\FlashMessage;
use App\Http\Resources\SupplyResource;
use App\Http\Resources\SupplyItemResource;
use App\Http\Requests\Supplies\StoreSupplyRequest;
use App\Http\Requests\Supplies\UpdateSupplyDetailsRequest;
use App\Http\Requests\Supplies\UpdateSupplyItemQuantityRequest;

class SuppliesController extends Controller
{
    use FlashMessage;

    protected SupplierController $supplierController;
    protected SupplyService $service;

    public function __construct(SupplyService $service, SupplierController $supplierController)
    {
        $this->supplierController = $supplierController;

        $this->service = $service;
    }


    public function index(Request $request)
    {
        $data = $this->getFlashMessage($request, []);

        return Inertia::render("Supplies/SuppliesScreen", $data);
    }

    public function browse(Request $request, $limit = 10)
    {
        $supplies = $this->service->browse($request->all(), $limit);

        return SupplyResource::collection($supplies);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
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
        $data = $this->getFlashMessage($request, []);

        $supply = $this->service->read($request->all(), $supply);

        $data['supply'] = new SupplyResource($supply);

        return Inertia::render("Supplies/SupplyScreen", $data);
    }

    public function read(Request $request, Supply $supply)
    {
        # code...
    }


    public function edit($id)
    {
    }


    public function updateSupplyDetails(UpdateSupplyDetailsRequest $request, Supply $supply)
    {
        return new SupplyResource($this->service->updateSupplyDetails($request->all(), $supply));
    }

    public function destroy($id)
    {
        //
    }

    public function readSupplyItem(Request $request, Supply $supply, SupplyItem $supply_item)
    {
        return new SupplyItemResource($this->service->readSupplyItem($request->all(), $supply_item));
    }

    public function editSupplyItemQuantity(UpdateSupplyItemQuantityRequest $request, Supply $supply, SupplyItem $supply_item)
    {
        $inputs = $request->validated();
        return new SupplyItemResource($this->service->updateSupplyItemQuantity($inputs, $supply_item));
    }

    public function deleteSupplyItem(Request $requset, Supply $supply, SupplyItem $supply_item)
    {
        return $this->service->deleteSupplyitem($supply_item);
    }

    public function export(Request $request, Supply $supply)
    {
        $pdf = PDF::loadView('pdf.supplies.supply', []);

        return $pdf->download('Supplies.pdf');
    }
}
