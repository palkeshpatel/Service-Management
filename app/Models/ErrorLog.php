<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'action',
        'message',
        'stack_trace',
        'payload',
        'ip_address',
        'user_agent',
    ];
}
