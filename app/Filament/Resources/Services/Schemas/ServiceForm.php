<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Service Name'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('default_price')
                    ->label(__('Default Price'))
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->prefix(__('SYP')),
            ]);
    }
}
