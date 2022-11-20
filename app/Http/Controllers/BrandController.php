<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BrandController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new BrandService();
    }

    public function getData($request)
    {
        $response = $this->service->browse($request);

        return $response;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->getData($request);

        return Inertia::render("Brands/BrandsScreen", $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render("Brands/Widgets/AddBrandForm");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {

        $data = $request->validated();

        try {
            $this->service->add($data);
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            return redirect()->back()->with('error', $this->service->parseError($errorCode, $data));
        }

        return Redirect::route("brands.browse")->with('success', 'Successfully added a new brand');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $data = [];

        if ($brand->id) {
            $data["brand"] = $brand;
        }

        return Inertia::render("Brands/Widgets/EditBrandForm", ["brand" => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();

        $brand->fill($data);

        $brand->save();

        return Redirect::route("brands.browse")->with('success', 'Brand was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Unable to delete brand');
        }

        return Redirect::route("brands.browse")->with('success', "Brand was succesfully deleted");
    }
}
