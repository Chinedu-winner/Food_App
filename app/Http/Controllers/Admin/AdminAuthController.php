<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessLog;

class AdminAuthController extends Controller{
    public function showLogin(){
        return view('admin.login');
    }

    public function login(Request $request){
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->intended('/home');
    }
    return back()->with('error', 'Invalid credentials');
    

    $credentials = $request->only('email','password');
    if (Auth::attempt($credentials)) {
        $request->session()->put('admin_id', $request->admin_id);
        return redirect()->route('admin.dashboard');
    }
    return back()->withInput()->with('error', 'Invalid login details');
}
    

    public function dashboard(){
        $uniqueUsers = AccessLog::select('name','email')
                        ->distinct()
                        ->get();

        return view('admin.dashboard', compact('uniqueUsers'));
    }
}