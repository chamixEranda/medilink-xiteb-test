<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AuthController;


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
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/sign-up', [AuthController::class, 'registerUser'])->name('sign-up');
Route::get('/login', [AuthController::class, 'loginUser'])->name('login');

Route::post('/signup/verify-email', [AuthController::class, 'verifySignupEmail'])->name('sign-up.verify-email');
Route::post('/signup/verify-email-otp', [AuthController::class, 'verifySignupEmailOtp'])->name('sign-up.verify-email-otp');
Route::post('/signup/store', [AuthController::class, 'registerStore'])->name('sign-up.store');

Route::get('/test-email', function () {
    Mail::to('chamitheranda00@gmail.com')->send(new EmailVerificationMail);
});

