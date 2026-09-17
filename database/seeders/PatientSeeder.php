<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();
        $doctor = User::where('email', 'doctor@demo.com')->firstOrFail();

        $patients = [
            [
                'name' => 'Ahmad Al-Khatib',
                'phone' => '+963 944 123 456',
                'age' => 34,
                'gender' => 'Male',
                'medical_history' => 'No known allergies. Occasional sensitivity to cold drinks.',
            ],
            [
                'name' => 'Maya Haddad',
                'phone' => '+963 933 246 810',
                'age' => 28,
                'gender' => 'Female',
                'medical_history' => 'No significant medical history. Reports dental anxiety.',
            ],
            [
                'name' => 'Omar Darwish',
                'phone' => '+963 991 357 924',
                'age' => 46,
                'gender' => 'Male',
                'medical_history' => 'Type 2 diabetes controlled with medication. No known drug allergies.',
            ],
            [
                'name' => 'Rana Al-Masri',
                'phone' => '+963 944 468 135',
                'age' => 19,
                'gender' => 'Female',
                'medical_history' => 'Healthy. Braces removed two years ago.',
            ],
            [
                'name' => 'Youssef Nasser',
                'phone' => '+963 933 579 246',
                'age' => 61,
                'gender' => 'Male',
                'medical_history' => 'Hypertension controlled with medication. Sensitive gums.',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::updateOrCreate(
                [
                    'clinic_id' => $clinic->id,
                    'name' => $patient['name'],
                ],
                [
                    ...$patient,
                    'user_id' => $doctor->id,
                ],
            );
        }
    }
}
