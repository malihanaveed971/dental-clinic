<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this line!

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create your test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Insert your 9 doctors directly into the dentists table
        DB::table('dentists')->insert([
            ['name' => 'Dr. Alice', 'specialization' => 'Orthodontics', 'phone' => '111-222'],
            ['name' => 'Dr. Bob', 'specialization' => 'General', 'phone' => '333-444'],
            ['name' => 'Dr. Charlie', 'specialization' => 'Surgery', 'phone' => '555-666'],
            // ... add the other 6 doctors here following this same pattern
        ]);
    }
}