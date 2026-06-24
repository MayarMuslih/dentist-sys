<?php

namespace App\Filament\Resources\Treatments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TreatmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required(),
                TextInput::make('tooth_number'),
                Textarea::make('medical_notes')
                    ->columnSpanFull(),
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('paid_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('remaining_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                DateTimePicker::make('treatment_date')
                    ->required(),
            ]);
    }
}
