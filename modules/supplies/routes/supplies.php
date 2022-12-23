<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\Supplies\App\Controllers\SuppliesController;

Route::middleware('auth')->group(function () {
    Route::post(                  '/supplies/{supply}/add',   [SuppliesController::class,     'addSupplyItem'])->name('supplies.supply.supply-item.add');
});
