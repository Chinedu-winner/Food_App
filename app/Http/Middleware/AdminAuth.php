<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth {
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'Access denied. You are not an admin.');
    }
}