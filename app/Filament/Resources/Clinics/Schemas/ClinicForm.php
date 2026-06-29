<?php

namespace App\Filament\Resources\Clinics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClinicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Clinic Name'))
                    ->required(),

                TextInput::make('phone')
                    ->label(__('Phone Number'))
                    ->tel()
                    ->numeric()
                    ->length(10)
                    ->required(),

                TextInput::make('address')
                    ->label(__('Address'))
                    ->required(),
            ]);
    }
}
