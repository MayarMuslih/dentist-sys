<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        Clinic::updateOrCreate(
            ['name' => 'Demo Dental Clinic'],
            [
                'phone' => '+963 11 555 0147',
                'address' => 'Abu Rummaneh, Damascus, Syria',
            ],
        );
    }
}
