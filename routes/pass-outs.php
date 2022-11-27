<?php

use App\Http\Controllers\PassOutsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    /**
     * Brands Router
     */
    Route::controller(PassOutsController::class)->group(function () {
        Route::match(["GET", "POST"],               '/pass-outs',                                           'index')->name('pass-outs.browse');
        Route::match(["GET", "POST"],               '/pass-outs/create',                                    'create')->name('pass-outs.create');
        Route::match(["GET", "POST"],               '/pass-outs/store',                                     'store')->name('pass-outs.store');
        Route::match(["GET", "POST"],               '/pass-outs/fetch-items',                               'getInventoryItems')->name('pass-outs.get-inventory-items');
        Route::match(["GET", "POST"],               '/pass-outs/redirect-to-browse',                        'redirectToBrowse')->name('pass-outs.redirect');
        Route::match(["GET", "POST"],               '/pass-outs/{pass_out}',                                'read')->name('pass-outs.show');
        Route::match(["GET", "POST"],               '/pass-outs/item/{pass_out_item}',                      'readPassOutItem')->name('pass-outs.item.read');
        Route::match(["GET", "POST"],               '/pass-outs/{pass_out}/item/{pass_out_item}/edit',      'updatePassOutItem')->name('pass-outs.item.update');
        Route::delete(                              '/pass-outs/{pass_out}/item/{pass_out_item}/delete',    'deletePassOutItem')->name('pass-outs.item.delete');
        Route::match(["GET", "POST"],               '/pass-outs/{pass_out}/refresh',                        'refreshPassOut')->name('pass-outs.pass-out.refresh');
        Route::match(["GET", "POST"],               '/pass-outs/{pass_out}/read-items',                     'readPassOutItems')->name('pass-outs.items.read');
    });
});
