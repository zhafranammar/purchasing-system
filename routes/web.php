<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::post('/order-items', [OrderController::class, 'addOrderItem']);
    Route::delete('/order-items/{id}', [OrderController::class, 'deleteOrderItem'])->name('order-items.delete');
    Route::resource('orders', OrderController::class);
});
Route::middleware(['auth', 'role:superadmin,staff'])->group(function () {
    Route::resource('orders', OrderController::class)->except(['update', 'destroy']);
    Route::post('/order-items', [OrderController::class, 'addOrderItem']);
    Route::delete('/order-items/{id}', [OrderController::class, 'deleteOrderItem'])->name('order-items.delete');
});
