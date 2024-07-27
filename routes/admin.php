<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin.guest')->prefix('backoffice')->name('admin.')->namespace('App\Http\Controllers\backend')->group(function () {

    require __DIR__.'/admin.guest.php';

});



Route::middleware('admin.auth')->prefix('backoffice')->name('admin.')->namespace('App\Http\Controllers\backend')->group(function () {
    require __DIR__.'/admin.auth.php';
});

