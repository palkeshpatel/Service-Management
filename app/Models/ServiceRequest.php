<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'request_id',
        'service_type',
        'name',
        'phone',
        'email',
        'city',
        'delivery_date',
        'invoice_no',
        'serial_number',
        'attachments',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'attachments' => 'array',
    ];

    public function getServiceTypeLabelAttribute()
    {
        return match($this->service_type) {
            'panel_damage' => 'Panel Damage (CRACK)',
            'junction_box' => 'Junction Box Burnt/Voltage Issue',
            'hotspot' => 'Hot-spot/Panel Burnt',
            default => $this->service_type,
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'in_progress' => 'info',
            'resolved' => 'success',
            'closed' => 'secondary',
            default => 'secondary',
        };
    }
}
