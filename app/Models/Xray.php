<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    protected $fillable = [
        'appointment_id',
        'xray_type',
        'unit_price',
        'line_total',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

