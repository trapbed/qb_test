<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){return view('index');})->name('index');

Route::post('/create_something', [PageController::class, 'create_something'])->name('create_something');
Route::post('/create_row', [PageController::class, 'create_row'])->name('create_row');
Route::get('/all_products', [PageController::class, 'all_products'])->name('all_products');
Route::get('/discount_product', [PageController::class, 'discount_product'])->name('discount_product');
Route::get('/new_product', [PageController::class, 'new_product'])->name('new_product');
Route::get('/wool_product', [PageController::class, 'wool_product'])->name('wool_product');
Route::get('/min_weight', [PageController::class, 'min_weight'])->name('min_weight');
Route::get('/wegetables_product', [PageController::class, 'wegetables_product'])->name('wegetables_product');
Route::get('/categories_product', [PageController::class, 'categories_product'])->name('categories_product');
Route::get('/change_data_type', [PageController::class,'change_data_type'])->name('change_data_type');
Route::get('/courier_ivan', [PageController::class, 'courier_ivan'])->name('courier_ivan');
Route::get('/courier_free', [PageController::class, 'courier_free'])->name('courier_free');
Route::get('/courier_status_change', [PageController::class, 'courier_status_change'])->name('courier_status_change');
