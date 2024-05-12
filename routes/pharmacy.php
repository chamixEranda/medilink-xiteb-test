<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pharmacy\AuthController;
use App\Http\Controllers\Pharmacy\HomeController;
use App\Http\Controllers\Pharmacy\QuotationController;
use App\Http\Controllers\Pharmacy\PrescriptionController;

Route::group(['namespace' => 'Pharmacy', 'as' => 'pharmacy.'], function() {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/submit', [AuthController::class, 'submit'])->name('submit');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    /*authentication*/

    Route::group(['middleware' => ['pharmacyauth']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::get('prescription/show-data', [PrescriptionController::class, 'show'])->name('prescription.show-data');
        Route::resource('prescription', PrescriptionController::class);

        Route::resource('quotation', QuotationController::class);
    });
});