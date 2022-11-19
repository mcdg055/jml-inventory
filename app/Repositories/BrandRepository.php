<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\Request;

class BrandRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Brand();
    }

    public function browse($inputs)
    {

        $search_input = "";
        if (isset($inputs['search'])) {
            $search_input = $inputs['search'];
        }
        $brands = $this->model->query()
            ->when($search_input, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($brand) => [
                'id' => $brand->id,
                'name' => $brand->name
            ]);

        $filters = ['search' => $search_input];

        $data = [
            'brands' => $brands,
            'filters' => $filters,
        ];

        return $data;
    }

    public function read(Request $request, Brand $brand)
    {
    }
    public function add($brand)
    {
        $this->model->fill($brand);
        
        $brand = $this->model->save();

        return $brand;
    }

    public function edit(Request $request, Brand $brand)
    {

    }

    public function update($brand, $data)
    {
        
    }

    public function delete(Request $request, Brand $brand)
    {
    }
}
