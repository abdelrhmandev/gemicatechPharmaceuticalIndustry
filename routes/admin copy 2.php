<?php
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

    Route::group(['namespace' => App\Http\Controllers\backend], function () {



        Route::group(['middleware' => 'admin.auth'], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');

            Route::resource('admin', [ProductController::class]);

            Route::resource('admins', AdminController::class)->except('show');
            //Route::delete('admins/destroy/all', 'AdminController@destroyMultiple')->name('categories.destroyMultiple');


            Route::resource('menus', MenuController::class)->except('show');
            //Route::delete('menus/destroy/all', 'MenuController@destroyMultiple')->name('menus.destroyMultiple');

            Route::resource('permissions', PermissionController::class)->except('show');
            //Route::delete('permissions/destroy/all', 'PermissionController@destroyMultiple')->name('permissions.destroyMultiple');


            Route::resource('socialNetworkLinks', SocialNetworkLinkController::class)->except('show');
            //Route::delete('socialNetworkLinks/destroy/all', 'SocialNetworkLinkController@destroyMultiple')->name('socialNetworkLinks.destroyMultiple');




            Route::resource('roles', RoleController::class)->except('show');
            //Route::delete('roles/destroy/all', 'RoleController@destroyMultiple')->name('roles.destroyMultiple');


            Route::resource('settings', SettingController::class)->except('show');
            //Route::delete('settings/destroy/all', 'SettingController@destroyMultiple')->name('products.destroyMultiple');



            Route::resource('categories', CategoryController::class)->except('show');
            //Route::delete('categories/destroy/all', 'CategoryController@destroyMultiple')->name('categories.destroyMultiple');






            // Route::resource('products', ProductController::class);
            // Route::delete('products/destroy/all', 'ProductController@destroyMultiple')->name('products.destroyMultiple');

            Route::get('/products/getSubCategories/{category_id}','ProductController@getSubCategories')->name('products.getSubCategories');

            Route::resource('industries', IndustryController::class)->except('show');
            //Route::delete('industries/destroy/all', 'IndustryController@destroyMultiple')->name('industries.destroyMultiple');


            Route::resource('sliders', SliderController::class)->except('show');
            //Route::delete('sliders/destroy/all', 'SliderController@destroyMultiple')->name('sliders.destroyMultiple');


            Route::resource('brands', BrandController::class)->except('show');
            //Route::delete('brands/destroy/all', 'BrandController@destroyMultiple')->name('brands.destroyMultiple');


            Route::resource('pages', PageController::class)->except('show');
            //Route::delete('pages/destroy/all', 'PageController@destroyMultiple')->name('pages.destroyMultiple');

            Route::resource('blocks', BlockController::class)->except('show');
            //Route::delete('blocks/destroy/all', 'BlockController@destroyMultiple')->name('blocks.destroyMultiple');


            ######################### Start Profile ##########################
            Route::group(['prefix' => 'profile'], function () {
                Route::get('/', 'ProfileController@index')->name('profile');
                Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
                Route::put('update', 'ProfileController@update')->name('profile.update');
                Route::get('/edit/password', 'ProfileController@editpassword')->name('profile.editpassword');
                Route::put('update/password', 'ProfileController@updatepassword')->name('profile.updatepassword');
            });
            ######################### End Profile ##########################

        ######################### Auth Routes #################################
        Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

        });

        ######################### Start Auth Guest Routes #################################
        Route::group(['prefix' => 'login'], function () {
            /////////////
            Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
            Route::post('/', 'Auth\LoginController@login')->name('login.submit');
        });
        #########################  End Password Reset Routes ###########################

        Route::group(['prefix' => 'email'], function () {
            Route::get('/verify', 'Auth\VerificationController@show')->name('auth.verification.notice');
            Route::get('/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('auth.verification.verify'); // v6.x
            Route::get('/resend', 'Auth\VerificationController@resend')->name('auth.verification.resend');
        });

        #########################  Start Password Reset Routes #########################
        Route::group(['prefix' => 'password'], function () {
            Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.request');
            Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.email');
            Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.reset');
            Route::post('/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.update');
        });
        #########################  End Password Reset Routes ###########################


    });
// });
