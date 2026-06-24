<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // اختيار المريض اللي عم يدفع
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required()
                    ->searchable()
                    ->preload() // بيحمل أسماء المرضى مسبقاً لتسريع البحث
                    ->label('اسم المريض'),

                // المبلغ المدفوع (حر بدون قيود أو تقريب)
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('ل.س')
                    ->label('المبلغ المدفوع'),

                // طريقة الدفع
                Select::make('payment_method')
                    ->options([
                        'cash' => 'كاش (نقدي)',
                        'credit_card' => 'بطاقة بنكية',
                        'transfer' => 'تحويل بنكي',
                    ])
                    ->default('cash')
                    ->required()
                    ->label('طريقة الدفع'),

                // تاريخ الدفعة (افتراضياً اليوم)
                DatePicker::make('payment_date')
                    ->required()
                    ->default(now())
                    ->label('تاريخ الدفعة'),

                // ملاحظات
                Textarea::make('notes')
                    ->columnSpanFull()
                    ->label('ملاحظات (اختياري)'),
            ]);
    }
}
