<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Make sure these match your database column names
    protected $fillable = ['patient_name', 'dentist_id', 'appointment_date'];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }
}