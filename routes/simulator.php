<?php

use App\Http\Controllers\Simulator\SimulatorController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "simulator", "middleware" => "auth"], function () {
    Route::match(["GET", "POST"],   '/supplies/{supply}/export',                             [SimulatorController::class,     'exportSupply'])->name('supplies.supply.export');
});
