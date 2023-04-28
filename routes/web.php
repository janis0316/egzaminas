<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController as P;
use App\Http\Controllers\MenuController as M;
use App\Http\Controllers\DishController as D;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [F::class, 'home'])->name('start');
Route::get('/dish/{dish}', [F::class, 'showDish'])->name('show-dish');
Route::get('/cat/{place}', [F::class, 'showCatDishes'])->name('show-cats-dishes');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [F::class, 'cart'])->name('cart');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order');

Route::prefix('admin/places')->name('places-')->group(function () {
    Route::get('/', [P::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [P::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [P::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{place}', [P::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{place}', [P::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{place}', [P::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/menus')->name('menus-')->group(function () {
    Route::get('/', [M::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [M::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [M::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{menu}', [M::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{menu}', [M::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{menu}', [M::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/dishes')->name('dishes-')->group(function () {
    Route::get('/', [D::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/show/{dish}', [D::class, 'show'])->name('show')->middleware('roles:A');
    Route::get('/create', [D::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [D::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{dish}', [D::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{dish}', [D::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{dish}', [D::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
