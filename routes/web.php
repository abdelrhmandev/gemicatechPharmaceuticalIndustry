<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\BrandController;

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndustryController;



Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/category/{slug}', [CategoryController::class, 'single'])->name('category');
Route::get('/industry/{slug}', [IndustryController::class, 'single'])->name('industry');
Route::get('/brand/{slug}', [BrandController::class, 'single'])->name('brand');

Auth::routes();

require __DIR__.'/admin.php';
