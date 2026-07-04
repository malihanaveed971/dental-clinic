<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create your test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
 
        // 2. Insert your 9 doctors directly into the dentists table with all required fields
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