<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();

        $treatments = [
            ['Ahmad Al-Khatib', 'Scaling & Polishing', null, 150000, '2026-07-08', 'Routine cleaning and polishing.'],
            ['Ahmad Al-Khatib', 'Composite Filling', '16', 250000, '2026-08-12', 'Composite restoration for tooth 16.'],
            ['Ahmad Al-Khatib', 'Root Canal', '46', 900000, '2026-08-26', 'Root canal treatment completed over two visits.'],
            ['Maya Haddad', 'Composite Filling', '21', 250000, '2026-08-19', 'Anterior composite restoration.'],
            ['Omar Darwish', 'Zirconia Crown', '16', 1500000, '2026-07-22', 'Crown cemented after preparation.'],
            ['Omar Darwish', 'Dental Implant', '46', 3500000, '2026-09-03', 'Implant placement follow-up.'],
            ['Rana Al-Masri', 'Scaling & Polishing', null, 150000, '2026-09-06', 'Preventive cleaning visit.'],
            ['Youssef Nasser', 'Extraction', '38', 300000, '2026-08-30', 'Uncomplicated extraction of lower third molar.'],
        ];

        foreach ($treatments as [$patientName, $serviceName, $toothNumber, $cost, $treatmentDate, $medicalNotes]) {
            $patient = Patient::where('clinic_id', $clinic->id)
                ->where('name', $patientName)
                ->firstOrFail();
            $service = Service::where('clinic_id', $clinic->id)
                ->where('name', $serviceName)
                ->firstOrFail();

            Treatment::updateOrCreate(
                [
                    'clinic_id' => $clinic->id,
                    'patient_id' => $patient->id,
                    'service_id' => $service->id,
                    'tooth_number' => $toothNumber,
                    'treatment_date' => $treatmentDate,
                ],
                [
                    'cost' => $cost,
                    'medical_notes' => $medicalNotes,
                ],
            );
        }
    }
}
