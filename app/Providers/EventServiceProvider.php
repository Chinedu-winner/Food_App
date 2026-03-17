<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Models\AdminAccessLog;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider{
    protected $listen = [
        
    ];

    public function boot(): void{
        parent::boot();

        Event::listen(Login::class, function ($event) {
            if ($event->user->admin_id) {
                try {
                    AdminAccessLog::create([
                        'admin_id' => $event->user->id,
                        'action' => 'Login',
                        'ip_address' => request()->ip(),
                        'details' => request()->userAgent(),
                    ]);
                } catch (\Exception $e) {
                    Log::error("Failed to log admin login: " . $e->getMessage());
                }
            }
        });
    }
}