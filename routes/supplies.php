<?php

use App\Http\Controllers\SuppliesController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::controller(SuppliesController::class)->group(function () {
        Route::match(["GET", "POST"],               '/supplies',                                           'index')->name('supplies.screen');
        Route::match(["GET", "POST"],               '/supplies/browse',                                    'browse')->name('supplies.browse');
        Route::match(["GET", "POST"],               '/supplies/add',                                       'create')->name('supplies.add');
        Route::post(                                '/supplies/store',                                     'store')->name('supplies.store');
        Route::match(["GET", "POST"],               '/supplies/{supply}',                                  'show')->name('supplies.supply.show');
        Route::post(                                '/supplies/{supply}/update',                           'update')->name('supplies.update');
        Route::delete(                              '/supplies/{supply}/delete',                           'destroy')->name('supplies.delete'); 
    });

    Route::match(["GET", "POST"],   '/supplies/{supply}/supply-item/{supply_item}' ,         [SuppliesController::class,     'readSupplyItem'])->name('supplies.supply.supply-item.read');
    Route::post(                    '/supplies/{supply}/supply-item/{supply_item}/edit',     [SuppliesController::class,     'editSupplyItemQuantity'])->name('supplies.supply.supply-item.edit');
});
