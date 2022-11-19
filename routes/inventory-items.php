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
        Route::match(["GET", "POST"],                       '/inventory-items',             'index')->name('brands.browse');
        Route::get('/brands/create',                        'create')->name('brands.create');
        Route::post('/brands/store',                        'store')->name('brands.store');
        Route::get('/brands/{brand}/edit',                  'edit')->name('brands.edit');
        Route::post('/brands/{brand}/update',               'update')->name('brands.update');
        Route::delete('/brands/{brand}/delete',             'destroy')->name('brands.delete');
    });
});
