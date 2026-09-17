<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();
        $doctor = User::where('email', 'doctor@demo.com')->firstOrFail();

        $services = [
            'Scaling & Polishing' => 150000,
            'Composite Filling' => 250000,
            'Root Canal' => 900000,
            'Extraction' => 300000,
            'Zirconia Crown' => 1500000,
            'Dental Implant' => 3500000,
        ];

        foreach ($services as $name => $defaultPrice) {
            Service::updateOrCreate(
                [
                    'clinic_id' => $clinic->id,
                    'name' => $name,
                ],
                [
                    'user_id' => $doctor->id,
                    'default_price' => $defaultPrice,
                ],
            );
        }
    }
}
