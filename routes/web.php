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

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories_index');
Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories_create');
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'createAction']);

Route::get('/categories/move-up/{id}', [\App\Http\Controllers\CategoryController::class, 'nodeUp']);
Route::get('/categories/move-down/{id}', [\App\Http\Controllers\CategoryController::class, 'nodeDown']);
