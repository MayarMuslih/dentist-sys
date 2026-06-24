<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true) // تجعل الاسم فريداً وتتخطى التحقق عند التعديل (Edit)
                    ->maxLength(255),

                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->length(10) // تجبر المستخدم على إدخال 10 أرقام تماماً لا زيادة ولا نقصان
                    ->regex('/^[0-9]+$/'), // تضمن عدم كتابة رموز أو أحرف داخل حقل الهاتف

                TextInput::make('age')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(120)
                    ->required(),

                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                Textarea::make('medical_history')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
