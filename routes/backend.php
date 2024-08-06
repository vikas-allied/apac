<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\AdminUserController;

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

        Route::get('roles/{roleId}/give-permission', [RoleController::class, 'addPermissionToRole'])->name('roles.add_permission');
        Route::put('roles/{roleId}/give-permission', [RoleController::class, 'givePermissionToRole'])->name('roles.give_permission');

        Route::resources([
            'roles'=> RoleController::class,
            'users' => AdminUserController::class,
        ]);

    });

});
