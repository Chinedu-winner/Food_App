<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthController extends Controller{
    public function showLogin(){
        return view('admin.login');
    }
    public function login(Request $request){
        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential)){
            return redirect()->route('admin.dashboard');
        } 
        return back()->with('error', 'Invalid login details');  

        $uniqueUser = AccessLog::select('name','email') 
                        ->distint()
                        ->get();
        return view('dashboard', compact('uniqueUsers')); 
        }
}
