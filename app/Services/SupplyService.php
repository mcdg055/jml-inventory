<?php

namespace App\Services;

use App\Models\Supply;
use App\Repositories\SupplyRepository;
use Illuminate\Http\Request;

class SupplyService
{
    protected $repository;

    public function __construct(SupplyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function browse(Request $request)
    {
    }

    public function read(Request $request, Supply $supply)
    {
    }

    public function edit(Request $request, Supply $supply)
    {
    }
    public function add($data)
    {
        $supply = $this->repository->insert($data);

        return $supply;
    }

    public function update($data, $supply)
    {
    }

    public function delete(Request $request, Supply $supply)
    {
    }
}
