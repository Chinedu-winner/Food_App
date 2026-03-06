<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/food', function () {
    return view('food');
});

Route::get('/order', function () {
    return view('order'); 
});

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::get('/register', function () {
    return view('register'); 
})->name('register');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'The provided credentials do not match our records.'])
        ->onlyInput('email');
})->name('login.submit');

Route::post('/register', function(Request $request) {
    $data = $request->validate([
        'name'     => ['required','string','max:255'],
        'email'    => ['required','email','max:255','unique:users'],
        'password' => ['required','confirmed','min:8'],
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
})->name('register.submit');

Route::get('/meal', function () {
    return view('meal');
})->name('meal');

Route::match(['GET', 'POST'], '/pay/{id}', function($id) {
    return (new PaymentController)->redirectToGateway($id);
})->name('pay');

// Route::match(['GET', 'POST'], '/pay/{id}', [PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::get('orders/{order}/track', function($order) {
    return "Tracking order: " . $order;
})->name('orders.track');

Route::get('orders/{order}/status', function($order) {
    return "Status of order: " . $order;
})->name('orders.status');

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');