<?php

namespace App\Listeners;

use App\Events\AdminLoginEvent;
use App\Models\AdminAccessLog;

class LogAdminLogin{
    public function handle(AdminLoginEvent $event){
        AdminAccessLog::create([
            'admin_id' => $event->user->id,
            'action' => 'Admin Logged In',
            'ip_address' => request()->ip(),
        ]);
    }
}