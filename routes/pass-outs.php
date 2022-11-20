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
        Route::match(["GET", "POST"],               '/pass-outs',                                     'index')->name('inventory-items.pass-outs');
    });
});
