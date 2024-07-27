<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ProductController;

Route::get('/', function () {
    return view('frontend.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


require __DIR__.'/admin.php';
