<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Filament\Resources\Patients\PatientResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    #[On('refresh-patient')]
    public function refreshPatientSummary()
    {
        // وجودها كافي لتحديث الصفحة فوراً
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
