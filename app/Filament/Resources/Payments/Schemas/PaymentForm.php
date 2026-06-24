<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Select::make('treatment_id')
                    ->relationship('treatment', 'id'),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
            ]);
    }
}
