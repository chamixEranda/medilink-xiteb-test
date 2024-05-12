<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pharmacy\AuthController;

Route::group(['namespace' => 'Pharmacy', 'as' => 'pharmacy.'], function() {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/submit', [AuthController::class, 'submit'])->name('submit');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    /*authentication*/
});