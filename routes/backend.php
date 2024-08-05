<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('admin')->namespace('App\Http\Controllers\Backend')->group(function() {
    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'],'/forgot-password','AuthController@forgotPassword')->name('forgot.password');
    Route::get('/reset-password/{token}/{email}','AuthController@resetPassword')->name('reset.password');
    Route::post('reset-password','AuthController@resetPassword')->name('reset.password');

    Route::group(['middleware'=>'is_admin'], function() {
        Route::get('/dashboard', function () {
            return view('backend.test');
        })->name('dashboard');


        Route::get('logout',[\App\Http\Controllers\Backend\AuthController::class, 'logout'])->name('logout');

    });

});
