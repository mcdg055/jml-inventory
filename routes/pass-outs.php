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
        Route::match(["GET", "POST"],               '/pass-outs',                                     'index')->name('pass-outs.browse');
        Route::match(["GET", "POST"],               '/pass-outs/create',                              'create')->name('pass-outs.create');
        Route::match(["GET", "POST"],               '/pass-outs/store',                               'store')->name('pass-outs.store');
        Route::match(["GET", "POST"],               '/pass-outs/fetch-items',                         'getInventoryItems')->name('pass-outs.store');
        Route::match(["GET", "POST"],               '/pass-outs/redirect-to-browse',                  'redirectToBrowse')->name('pass-outs.redirect');
    });
});