<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin.guest')->prefix('backoffice')->name('admin.')->namespace('App\Http\Controllers\backend')->group(function () {

            ######################### Start Auth Guest Routes #################################
            Route::group(['prefix' => 'login'], function () {
                /////////////
                Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
                Route::post('/','Auth\LoginController@login')->name('login.submit');
             });
            #########################  End Password Reset Routes ###########################

});



Route::middleware('admin.auth')->prefix('backoffice')->name('admin.')->namespace('App\Http\Controllers\backend')->group(function () {
//         ######################### Start Dashboard #################################
        Route::get('/', 'DashboardController@index')->name('dashboard');



        Route::resource('admins', AdminController::class)->except('show');
        Route::delete('admins/destroy/all', 'AdminController@destroyMultiple')->name('admins.destroyMultiple');


        Route::resource('menus', MenuController::class)->except('show');
        Route::delete('menus/destroy/all', 'MenuController@destroyMultiple')->name('menus.destroyMultiple');

        Route::resource('permissions', PermissionController::class)->except('show');
        Route::delete('permissions/destroy/all', 'PermissionController@destroyMultiple')->name('permissions.destroyMultiple');


        Route::resource('socialNetworkLinks', SocialNetworkLinkController::class)->except('show');
        Route::delete('socialNetworkLinks/destroy/all', 'SocialNetworkLinkController@destroyMultiple')->name('socialNetworkLinks.destroyMultiple');

        Route::resource('roles', RoleController::class)->except('show');
        Route::delete('roles/destroy/all', 'RoleController@destroyMultiple')->name('roles.destroyMultiple');


        Route::resource('settings', SettingController::class)->except('show');
        Route::delete('settings/destroy/all', 'SettingController@destroyMultiple')->name('settings.destroyMultiple');






        Route::resource('products', ProductController::class)->except('show');
        Route::delete('products/destroy/all', 'ProductController@destroyMultiple')->name('products.destroyMultiple');
        Route::get('/products/getSubCategories/{category_id}','ProductController@getSubCategories')->name('products.getSubCategories');


        Route::post('/Ajaxproducts/EditgetSubCategories','ProductController@EditgetSubCategories')->name('products.Edit.getSubCategories');



        Route::resource('categories', CategoryController::class)->except('show');
        Route::delete('categories/destroy/all', 'CategoryController@destroyMultiple')->name('categories.destroyMultiple');


        Route::resource('brands', BrandController::class)->except('show');
        Route::delete('brands/destroy/all', 'BrandController@destroyMultiple')->name('brands.destroyMultiple');

        Route::resource('industries', IndustryController::class)->except('show');
        Route::delete('industries/destroy/all', 'IndustryController@destroyMultiple')->name('industries.destroyMultiple');


        Route::resource('sliders', SliderController::class)->except('show');
        Route::delete('sliders/destroy/all', 'SliderController@destroyMultiple')->name('sliders.destroyMultiple');


        Route::resource('pages', PageController::class)->except('show');
        Route::delete('pages/destroy/all', 'PageController@destroyMultiple')->name('pages.destroyMultiple');

        Route::resource('blocks', BlockController::class)->except('show');
        Route::delete('blocks/destroy/all', 'BlockController@destroyMultiple')->name('blocks.destroyMultiple');


        Route::resource('socialnetworks', SocialNetworkController::class)->except('show');

        Route::post('/UpdateStatus', 'BaseController@UpdateStatus')->name('UpdateStatus');

        Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

        Route::get('/{id}/EditAdminPassword', 'AdminController@editpassword')->name('admins.editpassword');
        Route::put('update/AdminPassword', 'AdminController@updatepassword')->name('admins.updatepassword');

        ######################### Start Profile ##########################
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'ProfileController@index')->name('profile');
            Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('update', 'ProfileController@update')->name('profile.update');
            Route::get('/edit/password', 'ProfileController@editpassword')->name('profile.editpassword');
            Route::put('update/password', 'ProfileController@updatepassword')->name('profile.updatepassword');
        });
        ######################### End Profile ##########################
    });

