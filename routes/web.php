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

    route::get("/inventory-items", function () {
        return inertia::render('InventoryItems/InventoryItems', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('update', $user)
                    ],
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });

    /* create */
    route::get("/inventory-items/create", function () {
        return inertia::render("InventoryItems/CreateInventoryItem");
    });

    /* insert */
    route::post("/inventory-items", function () {
        //validate the request
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);


        //create the user
        User::create($attributes);

        //redirect to the page
        return redirect("/inventory-items");
    });

    route::get("/supplies", function () {
        return inertia::render('Supplies');
    });

    route::get("/suppliers", function () {
        return inertia::render('Suppliers');
    });
});