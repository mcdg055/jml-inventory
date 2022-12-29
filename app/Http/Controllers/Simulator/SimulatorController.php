<?php

namespace App\Http\Controllers\Simulator;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function exportSupply(Request $request, Supply $supply)
    {
        $supply->load(['supplier', 'receiver', 'supply_items', 'supply_items.inventory_item']);

        return view("pdf.supplies.supply")->with("supply", $supply);
    }
}
