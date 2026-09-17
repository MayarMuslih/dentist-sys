<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\PatientTooth;
use Illuminate\Database\Seeder;

class PatientToothSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();

        $charts = [
            'Ahmad Al-Khatib' => [
                16 => [PatientTooth::STATUS_DECAY, 'Occlusal decay requiring restoration.'],
                21 => [PatientTooth::STATUS_FILLED, 'Composite restoration completed.'],
                46 => [PatientTooth::STATUS_ROOT_CANAL, 'Root canal completed; crown recommended.'],
                38 => [PatientTooth::STATUS_MISSING, 'Extracted before joining the clinic.'],
                11 => [PatientTooth::STATUS_HEALTHY, null],
            ],
            'Omar Darwish' => [
                16 => [PatientTooth::STATUS_CROWN, 'Existing zirconia crown in good condition.'],
                21 => [PatientTooth::STATUS_FILLED, 'Old anterior composite filling.'],
                36 => [PatientTooth::STATUS_DECAY, 'Deep caries; treatment planned.'],
                38 => [PatientTooth::STATUS_MISSING, 'Missing lower third molar.'],
                46 => [PatientTooth::STATUS_IMPLANT, 'Implant-supported crown present.'],
            ],
            'Maya Haddad' => [
                11 => [PatientTooth::STATUS_HEALTHY, null],
                21 => [PatientTooth::STATUS_FILLED, 'Small composite restoration.'],
                26 => [PatientTooth::STATUS_DECAY, 'Early proximal decay.'],
            ],
        ];

        foreach ($charts as $patientName => $teeth) {
            $patient = Patient::where('clinic_id', $clinic->id)
                ->where('name', $patientName)
                ->firstOrFail();

            foreach ($teeth as $toothNumber => [$status, $notes]) {
                PatientTooth::updateOrCreate(
                    [
                        'patient_id' => $patient->id,
                        'tooth_number' => $toothNumber,
                    ],
                    [
                        'clinic_id' => $clinic->id,
                        'status' => $status,
                        'notes' => $notes,
                    ],
                );
            }
        }
    }
}
