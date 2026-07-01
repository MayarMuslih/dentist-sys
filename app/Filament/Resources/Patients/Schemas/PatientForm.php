<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Patient Name'))
                    ->required()
                    ->unique(
                        modifyRuleUsing: function (Unique $rule) {
                            return $rule->where('clinic_id', auth()->user()->clinic_id);
                        },
                        ignoreRecord: true
                    ),

                TextInput::make('phone')
                    ->label(__('Phone Number'))
                    ->tel()
                    ->numeric()
                    ->length(10)
                    ->maxLength(10)
                    ->required(),

                TextInput::make('age')
                    ->label(__('Age'))
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(120)
                    ->required(),

                Select::make('gender')
                    ->label(__('Gender'))
                    ->options([
                        'male' => __('Male'),
                        'female' => __('Female'),
                    ])
                    ->required(),

                Textarea::make('medical_history')
                    ->label(__('Medical History'))
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
