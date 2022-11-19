<?php

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class BrandService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new BrandRepository;
    }

    public function browse(Request $request)
    {
        $brands = $this->repository->browse($request->all());

        return $brands;
    }

    public function read(Request $request, Brand $brand)
    {
    }

    public function edit(Request $request, Brand $brand)
    {
    }
    public function add($brand)
    {

        if ($brand = $this->repository->add($brand)) {
            return ["success" => "Brand has been added successfully!"];
        }

        return ["error" => "Unable to save brand"];
    }

    public function update($data, $brand)
    {
        if ($brand = $this->repository->update($brand, $data)) {
           return true;
        }

        return false;
    }

    public function delete(Request $request, Brand $brand)
    {
    }
}
