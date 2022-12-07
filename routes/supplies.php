<?php

use App\Http\Controllers\SupplyController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::controller(SupplyController::class)->group(function () {
        Route::match(["GET", "POST"],               '/supplies',                                           'index')->name('supplies.screen');
        Route::match(["GET", "POST"],               '/supplies/browse',                                    'browse')->name('supplies.browse');
        Route::post(                                '/supplies/add',                                       'store')->name('supplies.store');
        Route::post(                                '/supplies/{supply}/show',                             'show')->name('supplies.edit');
        Route::post(                                '/supplies/{supply}/update',                           'update')->name('supplies.update');
        Route::delete(                              '/supplies/{supply}/delete',                           'destroy')->name('supplies.delete'); 
       
    });
});
