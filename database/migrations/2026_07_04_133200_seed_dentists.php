<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert dentists if table is empty
        if (DB::table('dentists')->count() === 0) {
            DB::table('dentists')->insert([
                ['name' => 'Dr. Ahmed Raza', 'specialization' => 'Oral Surgeon', 'phone' => '+923001122334', 'email' => 'ahmed.raza@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Sarah Khan', 'specialization' => 'Oral Surgeon', 'phone' => '+923005566778', 'email' => 'sarah.khan@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Bilal Tariq', 'specialization' => 'Oral Surgeon', 'phone' => '+923129988776', 'email' => 'bilal.tariq@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Hina Ali', 'specialization' => 'Orthodontist', 'phone' => '+923334455667', 'email' => 'hina.ali@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Usman Javed', 'specialization' => 'Orthodontist', 'phone' => '+923214433221', 'email' => 'usman.javed@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Areeba Noor', 'specialization' => 'Orthodontist', 'phone' => '+923451122998', 'email' => 'areeba.noor@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Zain Malik', 'specialization' => 'Endodontist', 'phone' => '+923017766554', 'email' => 'zain.malik@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Fatima Sheikh', 'specialization' => 'Endodontist', 'phone' => '+923348877665', 'email' => 'fatima.sheikh@clinic.com', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dr. Hamza Imran', 'specialization' => 'Endodontist', 'phone' => '+923159988443', 'email' => 'hamza.imran@clinic.com', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('dentists')->whereIn('email', [
            'ahmed.raza@clinic.com',
            'sarah.khan@clinic.com',
            'bilal.tariq@clinic.com',
            'hina.ali@clinic.com',
            'usman.javed@clinic.com',
            'areeba.noor@clinic.com',
            'zain.malik@clinic.com',
            'fatima.sheikh@clinic.com',
            'hamza.imran@clinic.com',
        ])->delete();
    }
};
