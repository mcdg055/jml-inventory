<?php

use App\Http\Controllers\PassOutsController;
use App\Http\Controllers\SupplierController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    /**
     * Brands Router
     */
    Route::controller(SupplierController::class)->group(function () {
        Route::match(["GET", "POST"],               '/suppliers',                                           'index')->name('suppliers.screen');
        Route::match(["GET", "POST"],               '/suppliers/browse',                                    'browse')->name('suppliers.browse');
        Route::post(                                '/suppliers/add',                                       'store')->name('suppliers.store');
        Route::post(                                '/suppliers/{supplier}/show',                           'show')->name('suppliers.edit');
        Route::post(                                '/suppliers/{supplier}/update',                         'update')->name('suppliers.update');
        Route::delete(                              '/suppliers/{supplier}/delete',                         'destroy')->name('suppliers.delete');
       
    });
});
