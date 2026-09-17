<?php

namespace App\Livewire;

use App\Models\Patient;
use App\Models\PatientTooth;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PatientDentalChart extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Patient $patient;

    #[Computed]
    public function teeth(): array
    {
        return $this->patient->teeth()
            ->get()
            ->mapWithKeys(fn (PatientTooth $tooth): array => [
                $tooth->tooth_number => [
                    'status' => $tooth->status,
                    'label' => $tooth->statusLabel(),
                    'notes' => $tooth->notes,
                    'color' => $this->statusBackgroundClasses($tooth->status),
                ],
            ])
            ->all();
    }

    public function editToothAction(): Action
    {
        return Action::make('editTooth')
            ->modalHeading(__('Edit Tooth'))
            ->fillForm(function (array $arguments = []): array {
                $toothNumber = $arguments['tooth_number'] ?? null;
                $tooth = $toothNumber !== null ? ($this->teeth[$toothNumber] ?? null) : null;

                return [
                    'status' => $tooth['status'] ?? PatientTooth::STATUS_HEALTHY,
                    'notes' => $tooth['notes'] ?? null,
                ];
            })
            ->schema([
                Select::make('status')
                    ->label(__('Status'))
                    ->options(fn (): array => collect(PatientTooth::statusOptions())
                        ->map(fn (string $label): string => __($label))
                        ->all())
                    ->required()
                    ->native(false),

                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->rows(4)
                    ->columnSpanFull(),
            ])
            ->action(function (array $arguments, array $data): void {
                $toothNumber = $arguments['tooth_number'] ?? null;

                if ($toothNumber === null) {
                    return;
                }

                PatientTooth::updateOrCreate(
                    [
                        'patient_id' => $this->patient->getKey(),
                        'tooth_number' => (int) $toothNumber,
                    ],
                    [
                        'clinic_id' => $this->patient->clinic_id,
                        'status' => $data['status'],
                        'notes' => $data['notes'] ?? null,
                    ],
                );

                unset($this->teeth);
            })
            ->successNotificationTitle(__('Tooth updated successfully'));
    }

    private function statusBackgroundClasses(string $status): string
    {
        return match ($status) {
            PatientTooth::STATUS_DECAY => 'border-red-300 bg-red-50 text-red-700 hover:bg-red-100 dark:border-red-800 dark:bg-red-950 dark:text-red-300 dark:hover:bg-red-900',
            PatientTooth::STATUS_FILLED => 'border-blue-300 bg-blue-50 text-blue-700 hover:bg-blue-100 dark:border-blue-800 dark:bg-blue-950 dark:text-blue-300 dark:hover:bg-blue-900',
            PatientTooth::STATUS_MISSING => 'border-gray-400 bg-gray-100 text-gray-700 hover:bg-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700',
            PatientTooth::STATUS_ROOT_CANAL => 'border-purple-300 bg-purple-50 text-purple-700 hover:bg-purple-100 dark:border-purple-800 dark:bg-purple-950 dark:text-purple-300 dark:hover:bg-purple-900',
            PatientTooth::STATUS_CROWN => 'border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 dark:border-amber-800 dark:bg-amber-950 dark:text-amber-300 dark:hover:bg-amber-900',
            PatientTooth::STATUS_IMPLANT => 'border-cyan-300 bg-cyan-50 text-cyan-700 hover:bg-cyan-100 dark:border-cyan-800 dark:bg-cyan-950 dark:text-cyan-300 dark:hover:bg-cyan-900',
            default => 'border-emerald-300 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 dark:hover:bg-emerald-900',
        };
    }

    public function render()
    {
        return view('livewire.patient-dental-chart');
    }
}
