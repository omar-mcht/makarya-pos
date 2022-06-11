<?php

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

Route::resource('/home', App\Http\Controllers\HomeController::class);
Route::resource('/transactions', App\Http\Controllers\TransactionController::class);
Route::resource('/products', App\Http\Controllers\ProductController::class);
Route::resource('/suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/details', App\Http\Controllers\TransactionDetailController::class);

Route::get('/api/suppliers', [App\Http\Controllers\SupplierController::class, 'api']);
Route::get('/api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
Route::get('/api/products', [App\Http\Controllers\ProductController::class, 'api']);
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);
Route::get('/api/details', [App\Http\Controllers\TransactionDetailController::class, 'api']);