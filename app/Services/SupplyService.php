<?php

namespace App\Services;

use App\Models\Supply;
use App\Repositories\SupplyRepository;
use Illuminate\Http\Request;

class SupplyService
{
    protected SupplyRepository $repository;

    public function __construct(SupplyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function browse($data)
    {
        $supplies = $this->repository->browse($data);

        $supplies->load(['supplier', 'receiver', 'items']);

        return $supplies;
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
