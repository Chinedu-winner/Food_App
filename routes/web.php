<?php
use App\Http\Controllers\Admin\AdminAccessLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Models\Order;
use App\Http\Controllers\Admin\AdminDashboardController;
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

Route::match(['GET', 'POST'], '/pay/{id}', 
    [PaymentController::class, 'redirectToGateway'
])->name('pay');

Route::get('/payment/callback',
    [PaymentController::class, 'handleCallback'])
->name('payment.callback');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])
    ->name('login.google'); 

Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('access-logs', [AdminAccessLogController::class, 'index'])->name('admin.access.logs');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/orders', function () {
        return "Orders page";
    })->name('admin.orders');

    Route::get('/foods', function () {
        return "Foods page";
    })->name('admin.foods');

    Route::get('/categories', function () {
        return "Categories page";
    })->name('admin.categories');

    Route::get('/users', function () {
        return "Users page";
})->name('admin.users');
});

// Temporary route to create an admin user
Route::get('/create-admin-user', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@foodwin.com',
        'password' => Hash::make('password123'),
        'admin_id' => '12345', // The ID you will enter in the form
        'is_admin' => true,
    ]);
    return "Admin user created! Email: admin@foodwin.com, Password: password123, Admin ID: 12345";
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::resource('food', \App\Http\Controllers\Admin\FoodController::class);
});

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('foods')->name('foods.')->group(function () {
        Route::get('/', [FoodController::class, 'index'])->name('index');
        Route::get('/create', [FoodController::class, 'create'])->name('create');
        Route::post('/', [FoodController::class, 'store'])->name('store');
        Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('edit');
        Route::put('/{food}', [FoodController::class, 'update'])->name('update');
        Route::delete('/{food}', [FoodController::class, 'destroy'])->name('destroy');
    });
});