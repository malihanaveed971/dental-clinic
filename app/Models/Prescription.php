<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'appointment_id',
        'medication_name',
        'quantity',
        'unit_price',
        'line_total',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

