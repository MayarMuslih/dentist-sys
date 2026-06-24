<?php

namespace App\Filament\Resources\Treatments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Service;

class TreatmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // اختيار المريض
                Select::make('patient_id')
                    ->relationship('patient', 'name') // يفترض أن المريض له حقل اسمه name
                    ->required()
                    ->searchable()
                    ->label('اسم المريض'),

                // اختيار الخدمة (مع سحب السعر تلقائياً)
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required()
                    ->searchable()
                    ->label('الخدمة المقدمة')
                    ->live() // يراقب التغييرات على هذا الحقل لحظياً
                    ->afterStateUpdated(function ($state, callable $set) {
                        // إذا تم اختيار خدمة، اسحب سعرها وضعه في حقل التكلفة
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
                    ->label('رقم السن (اختياري)'),

                // تاريخ الجلسة
                DatePicker::make('treatment_date')
                    ->required()
                    ->default(now()) // يضع تاريخ اليوم افتراضياً
                    ->label('تاريخ الجلسة'),

                // تكلفة العلاج
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('ل.س')
                    ->label('التكلفة النهائية'),

                // ملاحظات طبية
                Textarea::make('medical_notes')
                    ->columnSpanFull() // يأخذ عرض الشاشة بالكامل لسهولة الكتابة
                    ->label('ملاحظات طبية (اختياري)'),
            ]);
    }
}
