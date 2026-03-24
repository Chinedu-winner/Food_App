<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller{
    public function showLogin(){
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request){
            $data = $request->validate([
            'email' => 'required|email',
            'admin_id' => 'required',
            'password' => 'required',
        ]);

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make($data['password']),
                    'admin_id' => $data['admin_id'],
                    'is_admin' => true
                ]
            );

            if (!$user->is_admin) {
                $user->is_admin = true;
                $user->save();
            }

            Auth::login($user, $request->has('remember'));

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}