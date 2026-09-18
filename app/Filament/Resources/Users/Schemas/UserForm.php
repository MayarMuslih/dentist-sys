<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('role')
                    ->label(__('Role'))
                    ->options(fn (string $operation): array => $operation === 'create'
                        ? ['doctor' => __('Doctor')]
                        : [
                            'doctor' => __('Doctor'),
                            'super_admin' => __('Super Admin'),
                        ])
                    ->default('doctor')
                    ->required(),

                Select::make('clinic_id')
                    ->label(__('Clinic'))
                    ->relationship('clinic', 'name')
                    ->searchable()
                    ->preload()
                    ->required(fn (string $operation, $get): bool => $operation === 'create' && $get('role') === 'doctor')
                    ->nullable(),

                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),

                TextInput::make('email')
                    ->label(__('Email Address'))
                    ->email()
                    ->unique(ignoreRecord: true) // بيمنع تكرار الإيميل، وبيتجاهل السجل الحالي عند التعديل
                    ->required(),

                TextInput::make('password')
                    ->label(__('Password'))
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }
}
