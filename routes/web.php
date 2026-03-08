<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Public pages
Route::view('/', 'welcome')->name('home');
Route::view('/food', 'food')->name('food');
Route::view('/meal', 'meal')->name('meal');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

// Auth routes
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.submit');

// Social login
Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('login.google.callback');

// Protected routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

    // Track
    Route::get('/track', [OrderController::class, 'showTrackForm'])->name('track.form');
    Route::post('/track', [OrderController::class, 'track'])->name('track');

    // Payment
    Route::match(['GET', 'POST'], '/pay/{id}', [PaymentController::class, 'redirectToGateway'])->name('pay');
    Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay.post');
    Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
});

// Admin routes
Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminAuthController::class, 'orders'])->name('admin.orders');
});

Route::get('/admin/login', [AdminAuthController::class,'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class,'login'])->name('admin.login.submit');
