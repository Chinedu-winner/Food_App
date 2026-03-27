<?php

namespace App\Listeners;

use App\Events\AdminLoginEvent;
use App\Models\AdminAccessLog;

class LogAdminLogin{
    public function handle(Login $event){
        $user = $event->user;

        // Only log admins
        if ($user->is_admin) {
            AdminAccessLog::create([
                'admin_id' => $user->id,
                'ip_address' => request()->ip(),
                'device' => request()->header('User-Agent'),
            ]);
        }
    }
}