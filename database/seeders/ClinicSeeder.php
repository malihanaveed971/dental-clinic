<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\User; // Importing the User model for authentication
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign keys to safely clear old records without errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Patient::truncate();
        Dentist::truncate();
        Specialization::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create a Real Test Account for Patient Login testing
        // This links to Laravel's default authentication system
        User::create([
            'name' => 'Test Patient',
            'email' => 'patient@test.com',
            'password' => Hash::make('password123'), // You will use this to test your login page!
        ]);

        // 2. Insert Mandatory Specializations
        $oralSurgeon = Specialization::create([
            'specialization_name' => 'Oral Surgeon',
            'description' => 'Specializes in complex extractions, jaw surgery, and implants.'
        ]);

        $orthodontist = Specialization::create([
            'specialization_name' => 'Orthodontist',
            'description' => 'Specializes in correcting misaligned teeth and braces.'
        ]);

        $endodontist = Specialization::create([
            'specialization_name' => 'Endodontist',
            'description' => 'Specializes in root canal treatments.'
        ]);

        // 3. Insert 9 Required Dentist Profiles (3 per specialization)
        // Oral Surgeons
        Dentist::create([
            'specialization_id' => $oralSurgeon->specialization_id,
            'first_name' => 'Ahmed', 'last_name' => 'Raza', 'gender' => 'Male',
            'phone' => '+923001122334', 'email' => 'ahmed.raza@clinic.com',
            'qualification' => 'BDS, FCPS (Oral Surgery)', 'experience_years' => 12,
            'address' => 'University Road, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $oralSurgeon->specialization_id,
            'first_name' => 'Sarah', 'last_name' => 'Khan', 'gender' => 'Female',
            'phone' => '+923005566778', 'email' => 'sarah.khan@clinic.com',
            'qualification' => 'BDS, MDS', 'experience_years' => 8,
            'address' => 'Hayatabad Phase 3, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $oralSurgeon->specialization_id,
            'first_name' => 'Bilal', 'last_name' => 'Tariq', 'gender' => 'Male',
            'phone' => '+923129988776', 'email' => 'bilal.tariq@clinic.com',
            'qualification' => 'BDS, MCPS', 'experience_years' => 10,
            'address' => 'Saddar, Peshawar Cantt'
        ]);

        // Orthodontists
        Dentist::create([
            'specialization_id' => $orthodontist->specialization_id,
            'first_name' => 'Hina', 'last_name' => 'Ali', 'gender' => 'Female',
            'phone' => '+923334455667', 'email' => 'hina.ali@clinic.com',
            'qualification' => 'BDS, FCPS (Orthodontics)', 'experience_years' => 9,
            'address' => 'Town, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $orthodontist->specialization_id,
            'first_name' => 'Usman', 'last_name' => 'Javed', 'gender' => 'Male',
            'phone' => '+923214433221', 'email' => 'usman.javed@clinic.com',
            'qualification' => 'BDS, MS (Orthodontics)', 'experience_years' => 11,
            'address' => 'Ring Road, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $orthodontist->specialization_id,
            'first_name' => 'Areeba', 'last_name' => 'Noor', 'gender' => 'Female',
            'phone' => '+923451122998', 'email' => 'areeba.noor@clinic.com',
            'qualification' => 'BDS, DDS', 'experience_years' => 6,
            'address' => 'Gulbahar, Peshawar'
        ]);

        // Endodontists
        Dentist::create([
            'specialization_id' => $endodontist->specialization_id,
            'first_name' => 'Zain', 'last_name' => 'Malik', 'gender' => 'Male',
            'phone' => '+923017766554', 'email' => 'zain.malik@clinic.com',
            'qualification' => 'BDS, FCPS', 'experience_years' => 7,
            'address' => 'Hayatabad Phase 5, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $endodontist->specialization_id,
            'first_name' => 'Fatima', 'last_name' => 'Sheikh', 'gender' => 'Female',
            'phone' => '+923348877665', 'email' => 'fatima.sheikh@clinic.com',
            'qualification' => 'BDS, MDS (Endodontics)', 'experience_years' => 14,
            'address' => 'Dalazak Road, Peshawar'
        ]);
        Dentist::create([
            'specialization_id' => $endodontist->specialization_id,
            'first_name' => 'Hamza', 'last_name' => 'Imran', 'gender' => 'Male',
            'phone' => '+923159988443', 'email' => 'hamza.imran@clinic.com',
            'qualification' => 'BDS, M-Endo', 'experience_years' => 5,
            'address' => 'Charsadda Road, Peshawar'
        ]);
    }
}