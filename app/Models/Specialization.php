<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $primaryKey = 'specialization_id';
    protected $fillable = ['specialization_name', 'description'];

    public function dentists() {
        return $this->hasMany(Dentist::class, 'specialization_id');
    }
}