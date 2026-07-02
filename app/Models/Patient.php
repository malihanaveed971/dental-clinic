<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'patient_id';
    protected $fillable = ['patient_name', 'patient_address', 'patient_phone', 'patient_gender', 'patient_date_of_birth'];
}