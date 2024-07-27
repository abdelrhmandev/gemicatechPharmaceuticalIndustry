<?php
            ######################### Start Auth Guest Routes #################################
            Route::group(['prefix' => 'login'], function () {
                /////////////
                Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
                Route::post('/','Auth\LoginController@login')->name('login.submit');
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

?>
