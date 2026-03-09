<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Models\Order;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/food', function () {
    return view('food');
})->name('food');

Route::get('/order', function () {
    return view('order'); 
})->name('order');

Route::post('/order', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string',
        'food_name' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]);

    $order = Order::create([
        'user_id' => Auth::id(),
        'name' => $data['name'],
        'food_name' => $data['food_name'],
        'quantity' => $data['quantity'],
        'price' => $data['price'],
        'total' => $data['price'] * $data['quantity'],
        'address' => Auth::user()->address,
        'status' => 'pending',
    ]);

    return redirect('/dashboard')->with('success', 'Order placed successfully!');
})->middleware('auth');

Route::get('/track', function () {
    return view('track'); 
})->middleware('auth')->name('track');

Route::post('/track', function (Request $request) {
    $request->validate(['order_id' => 'required|integer']);
    
    $order = Order::where('id', $request->order_id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$order) {
        return back()->withErrors(['order_id' => 'Order not found or does not belong to you.']);
    }

    return redirect()->route('orders.track', ['order' => $order->id]);
})->middleware('auth');

Route::post('/track', function (Request $request) {
    $request->validate(['order_id' => 'required|integer']);

    $order = Order::where('id', $request->order_id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$order) {
        return back()->withErrors(['order_id' => 'Order not found or does not belong to you.']);
    }

    return redirect()->route('orders.track', ['order' => $order->id]);
})->middleware('auth');
Route::get('orders/{order}/status', function($order) {
    return "Status of order: " . $order;
})->name('orders.status');

Route::get('/login', function () {
    return view('login'); 
})->name('login');

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

Route::get('/register', function () {
    return view('register'); 
})->name('register');

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

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');

Route::get('/admin/login', [AdminAuthController::class,'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class,'login'])
    ->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');