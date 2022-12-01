<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{

    protected Supplier $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render("Suppliers/SuppliersScreen");
    }

    public function browse(Request $request)
    {

        $inputs = $request->all();
        $search_input = "";

        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }

        $suppliers = $this->supplier->query()
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
                $query->orWhere('contact_person', 'like', "%{$search}%");
                $query->orWhere('contact_number', 'like', "%{$search}%");
            })
            ->get();

        return SupplierResource::collection($suppliers);
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
    public function store(StoreSupplierRequest $request)
    {
        $data = $request->validated();

        $this->supplier->fill($data);

        try {
            $this->supplier->save();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

        return ['success' => "Supplier was successfully added!"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();

        try {
            $supplier->fill($data);
            $supplier->save();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

        return ['success' => "Supplier was successfully updated!"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }

        return ['success' => "Supplier was successfully deleted!"];
    }
}
