<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAccessLog; 

class AdminDashboardController extends Controller{
    public function __construct(){
        $this->middleware(['admin']); 
    }

    public function index(){
        $recentLogins = AdminAccessLog::with('admin')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('recentLogins'));
    }
}