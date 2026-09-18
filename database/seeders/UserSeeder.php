<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();

        User::updateOrCreate(
            ['email' => 'doctor@demo.com'],
            [
                'name' => 'Dr. Lina Haddad',
                'clinic_id' => $clinic->id,
                'role' => 'doctor',
                'password' => 'password123',
            ],
        );

        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Demo Clinic Admin',
                'clinic_id' => $clinic->id,
                'role' => 'doctor',
                'password' => 'password123',
            ],
        );

        User::updateOrCreate(
            ['email' => 'admin@dentalflow.com'],
            [
                'name' => 'DentalFlow Super Admin',
                'clinic_id' => null,
                'role' => 'super_admin',
                'password' => 'password',
            ],
        );
    }
}
