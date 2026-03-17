<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAccessLog extends Model
{
    protected $table = 'access_logs';
    protected $guarded = [];

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}