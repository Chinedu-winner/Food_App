<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;

class AdminAuthController extends Controller{
    public function dashboard(){
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $uniqueUsers = AccessLog::select('name', 'email')
                                ->distinct()
                                ->get();

        return view('admin.dashboard', compact('uniqueUsers'));
    }
}