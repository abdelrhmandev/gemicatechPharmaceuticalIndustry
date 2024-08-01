<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PageController;
use App\Http\Controllers\frontend\BrandController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndustryController;
use App\Http\Controllers\frontend\ContactusController;



Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/categories/{slug?}', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'single'])->name('category');


Route::get('/product/{slug}', [ProductController::class, 'single'])->name('product');
Route::get('/product/category/{slug}', [ProductController::class, 'prductsByCategory'])->name('products.byCategory');



Route::get('/industry/{slug}', [IndustryController::class, 'single'])->name('industry');
Route::get('/industries/', [IndustryController::class, 'index'])->name('industries.index');


Route::get('/brand/{slug}', [BrandController::class, 'single'])->name('brand');

Route::get('/page/{slug}', [PageController::class, 'single'])->name('page');


Route::post('/contactus/store', [ContactusController::class, 'store'])->name('contactus.store');

Auth::routes();

require __DIR__.'/admin.php';
