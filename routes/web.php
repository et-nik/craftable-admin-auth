<?php

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

Route::middleware(['web'])->group(function () {
    Route::namespace('Brackets\AdminAuth\Http\Controllers\Auth')->group(function () {
        Route::get('/admin/login',                          'LoginController@showLoginForm')->name('craftable/admin-auth::admin/login');
        Route::post('/admin/login',                         'LoginController@login');

        Route::any('/admin/logout',                         'LoginController@logout')->name('craftable/admin-auth::admin/logout');

        Route::get('/admin/password-reset',                 'ForgotPasswordController@showLinkRequestForm')->name('craftable/admin-auth::admin/password/showForgotForm');
        Route::post('/admin/password-reset/send',           'ForgotPasswordController@sendResetLinkEmail');
        Route::get('/admin/password-reset/{token}',         'ResetPasswordController@showResetForm')->name('craftable/admin-auth::admin/password/showResetForm');
        Route::post('/admin/password-reset/reset',          'ResetPasswordController@reset');

        Route::get('/admin/activation/{token}',             'ActivationController@activate')->name('craftable/admin-auth::admin/activation/activate');
    });
});

Route::middleware(['web', 'admin', 'auth:' . config('admin-auth.defaults.guard')])->group(function () {
    Route::namespace('Brackets\AdminAuth\Http\Controllers')->group(function () {
        Route::get('/admin',                                'AdminHomepageController@index')->name('craftable/admin-auth::admin');
    });
});
