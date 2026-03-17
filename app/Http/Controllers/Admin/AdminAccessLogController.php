<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAccessLogController extends Controller{
    public function index(){
        $logs = AdminAccessLog::with('admin')->latest()->paginate(20);

        return view('admin.access-logs', compact('logs'));
    }
}
