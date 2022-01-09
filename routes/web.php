<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ProductsController;

// Products
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductsController::class, 'find'])->name('products.find');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products/create', [ProductsController::class, 'store']);
Route::post('/products/{id}', [ProductsController::class, 'update']);
Route::delete('/products/{id}', [ProductsController::class, 'destroy']);

// Tags
Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('/tags/{id}', [TagsController::class, 'find'])->name('tags.find');
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('/tags/create', [TagsController::class, 'store']);
Route::post('/tags/{id}', [TagsController::class, 'update']);
Route::delete('/tags/{id}', [TagsController::class, 'destroy']);