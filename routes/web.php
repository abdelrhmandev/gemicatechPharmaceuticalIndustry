<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
require __DIR__.'/admin.php';
