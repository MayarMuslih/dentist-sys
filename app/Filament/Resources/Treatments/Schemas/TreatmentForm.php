<?php

namespace App\Filament\Resources\Treatments\Schemas;

use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TreatmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required()
                    ->searchable()
                    ->label(__('Patient Name')),

                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required()
                    ->searchable()
                    ->label(__('Provided Service'))
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $service = Service::find($state);
                            if ($service) {
                                $set('cost', $service->default_price);
                            }
                        }
                    }),

                // رقم السن
                TextInput::make('tooth_number')
                    ->maxLength(255)
                    ->label(__('Tooth Number (Optional)')),

                // تاريخ الجلسة
                DatePicker::make('treatment_date')
                    ->required()
                    ->default(now()) // يضع تاريخ اليوم افتراضياً
                    ->label(__('Session Date')),

                // تكلفة العلاج
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix(__('SYP'))
                    ->label(__('Final Cost')),

                // ملاحظات طبية
                Textarea::make('medical_notes')
                    ->columnSpanFull() // يأخذ عرض الشاشة بالكامل لسهولة الكتابة
                    ->label(__('Medical Notes (Optional)')),
            ]);
    }
}
