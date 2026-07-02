<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // Appointment_ID
            
            // Patient details and appointment timing
            $table->string('patient_name'); 
            $table->dateTime('appointment_date'); 
            
            // Foreign key linking to the dentists table
            // Note: This assumes you have a table named 'dentists'
            $table->foreignId('dentist_id')->constrained(); 
            
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};