<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller{
    public function showLogin(){
        if (Auth::check() && Auth::user()->admin_id) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Enforce admin access check immediately after login
            if (Auth::user()->admin_id) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
            }

            // If credentials are valid but user is not an admin
            Auth::logout();
            return back()->with('error', 'Access denied. You do not have administrative privileges.')->onlyInput('email');
        }

        return back()->withInput()->with('error', 'Invalid credentials');
    }
}