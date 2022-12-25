<?php

use App\Http\Controllers\Simulator\SimulatorController;
use Illuminate\Support\Facades\Route;

Route::match(["GET", "POST"],   '/simulator/export',                             [SimulatorController::class,     'export'])->name('supplies.update');