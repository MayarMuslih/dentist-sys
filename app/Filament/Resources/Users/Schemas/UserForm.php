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
                Select::make('clinic_id')
                    ->label(__('Clinic'))
                    ->relationship('clinic', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(), // مهم جداً عشان تقدر تنشئ حسابات مدراء تانيين بدون عيادة

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
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // تشفير الباسورد
                    ->dehydrated(fn ($state) => filled($state)) // لا تحفظ الحقل إذا كان فاضي (عند التعديل)
                    ->required(fn (string $operation): bool => $operation === 'create'), // مطلوب فقط عند الإنشاء
            ]);
    }
}
