<?php

use App\Http\Controllers\SuppliesController;

use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::controller(SuppliesController::class)->group(function () {
        Route::match(["GET", "POST"],               '/supplies',                                           'index')->name('supplies.screen');
        Route::match(["GET", "POST"],               '/supplies/browse',                                    'browse')->name('supplies.browse');
        Route::match(["GET", "POST"],               '/supplies/add',                                       'create')->name('supplies.add');
        Route::post(                                '/supplies/store',                                     'store')->name('supplies.store');
        Route::match(["GET", "POST"],               '/supplies/{supply}',                                  'show')->name('supplies.supply.show');
        Route::delete(                              '/supplies/{supply}/delete',                           'destroy')->name('supplies.delete'); 
    });

    Route::post(                    '/supplies/{supply}/update',                             [SuppliesController::class,     'updateSupplyDetails'])->name('supplies.update');
    Route::match(["GET", "POST"],   '/supplies/{supply}/export',                             [SuppliesController::class,     'export'])->name('supplies.update');
    Route::match(["GET", "POST"],   '/supplies/{supply}/supply-item/{supply_item}' ,         [SuppliesController::class,     'readSupplyItem'])->name('supplies.supply.supply-item.read');
    Route::post(                    '/supplies/{supply}/supply-item/{supply_item}/edit',     [SuppliesController::class,     'editSupplyItemQuantity'])->name('supplies.supply.supply-item.edit');
    Route::delete(                  '/supplies/{supply}/supply-item/{supply_item}/delete',   [SuppliesController::class,     'deleteSupplyItem'])->name('supplies.supply.supply-item.delete');
});
