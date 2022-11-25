<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\InventoryItemsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    /**
     * Brands Router
     */
    Route::controller(InventoryItemsController::class)->group(function () {
        Route::match(["GET", "POST"],               '/inventory-items',                                     'index')->name('inventory-items.browse');
        Route::match(["GET", "POST"],               '/inventory-items/create',                              'create')->name('inventory-items.create');
        Route::post(                                '/inventory-items/store',                               'store')->name('inventory-items.store');
        Route::get(                                 '/inventory-items/{inventory_item}/edit',               'edit')->name('inventory-items.edit');
        Route::get(                                 '/inventory-items/{inventory_item}',                    'show')->name('inventory-items.show');
        Route::post(                                '/inventory-items/{inventory_item}/add-stock',          'addStock')->name('inventory-items.stock.add');
        Route::post(                                '/inventory-items/{inventory_item}/update',             'update')->name('inventory-items.update');
        Route::delete(                              '/inventory-items/{inventory_item}/delete',             'destroy')->name('inventory-items.delete');
    });
});
