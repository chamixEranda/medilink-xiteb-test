<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\PrescriptionController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sign-up', [AuthController::class, 'registerUser'])->name('sign-up');
Route::get('/login', [AuthController::class, 'loginUser'])->name('login');

Route::post('/signup/verify-email', [AuthController::class, 'verifySignupEmail'])->name('sign-up.verify-email');
Route::post('/signup/verify-email-otp', [AuthController::class, 'verifySignupEmailOtp'])->name('sign-up.verify-email-otp');
Route::post('/signup/store', [AuthController::class, 'registerStore'])->name('sign-up.store');

Route::post('/logout', [AuthController::class, 'logOutUser'])->name('logout');

Route::post('/login/check', [AuthController::class, 'loginCheck'])->name('login.check');

Route::resource('prescription', PrescriptionController::class);
