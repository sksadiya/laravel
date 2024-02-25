<?php

use App\Http\Controllers\HomeController;
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
// Route::get('/home', function () {
//     return view('home');
// });
route::get('/',[HomeController::class,'index']);

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-product', [App\Http\Controllers\HomeController::class, 'add_product']);
Route::get('/show-product', [App\Http\Controllers\HomeController::class, 'show_product']);
Route::get('delete-product/{id}', [App\Http\Controllers\HomeController::class, 'delete_product']);
Route::get('edit-product/{id}', [App\Http\Controllers\HomeController::class, 'edit_product']);
Route::post('update-product/{id}', [App\Http\Controllers\HomeController::class, 'update_product']);
Route::get('search', [App\Http\Controllers\HomeController::class, 'search'])->name('product.search');;