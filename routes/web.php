<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'create'])->name("login");
Route::post('login', [LoginController::class, 'store'])->name("login.authenticate");
Route::post('logout', [LoginController::class, 'destroy'])->name("logout")->middleware("auth");

Route::middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return inertia::render('Home', []);
    })->name("home");
});
