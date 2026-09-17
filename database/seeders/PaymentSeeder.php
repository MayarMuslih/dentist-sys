<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::where('name', 'Demo Dental Clinic')->firstOrFail();

        $payments = [
            ['Ahmad Al-Khatib', 150000, 'cash', '2026-07-08', 'Paid in full for cleaning.'],
            ['Ahmad Al-Khatib', 500000, 'cash', '2026-08-12', 'Installment toward restorative treatment.'],
            ['Ahmad Al-Khatib', 300000, 'transfer', '2026-08-26', 'Second installment.'],
            ['Maya Haddad', 250000, 'cash', '2026-08-19', 'Paid in full.'],
            ['Omar Darwish', 1000000, 'transfer', '2026-07-22', 'First crown and implant installment.'],
            ['Omar Darwish', 1500000, 'cash', '2026-09-03', 'Implant treatment installment.'],
            ['Rana Al-Masri', 150000, 'cash', '2026-09-06', 'Paid in full.'],
            ['Youssef Nasser', 150000, 'cash', '2026-08-30', 'Partial payment; balance remains.'],
        ];

        foreach ($payments as [$patientName, $amount, $paymentMethod, $paymentDate, $notes]) {
            $patient = Patient::where('clinic_id', $clinic->id)
                ->where('name', $patientName)
                ->firstOrFail();

            Payment::updateOrCreate(
                [
                    'clinic_id' => $clinic->id,
                    'patient_id' => $patient->id,
                    'amount' => $amount,
                    'payment_method' => $paymentMethod,
                    'payment_date' => $paymentDate,
                ],
                [
                    'notes' => $notes,
                ],
            );
        }
    }
}
