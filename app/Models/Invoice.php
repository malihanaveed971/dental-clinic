<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'appointment_id',
        'patient_name',
        'medications_total',
        'xrays_total',
        'grand_total',
        'invoice_no',
        'status',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function lineItems()
    {
        return $this->hasMany(InvoiceLineItem::class);
    }
}

