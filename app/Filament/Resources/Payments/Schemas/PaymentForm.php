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
                    ->label(__('Patient Name')),

                // المبلغ المدفوع (حر بدون قيود أو تقريب)
                TextInput::make('amount')
                    ->label(__('Paid Amount'))
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix(__('SYP')), // رمز العملة

                // طريقة الدفع
                Select::make('payment_method')
                    ->label(__('Payment Method'))
                    ->options([
                        'cash' => __('Cash'),
                        // 'credit_card' => 'Credit Card',
                        // 'transfer' => 'Bank Transfer',
                    ])
                    ->default('cash')
                    ->required(),

                // تاريخ الدفعة (افتراضياً اليوم)
                DatePicker::make('payment_date')
                    ->required()
                    ->default(now())
                    ->label(__('Payment Date')),

                // ملاحظات
                Textarea::make('notes')
                    ->columnSpanFull()
                    ->label(__('Notes')),
            ]);
    }
}
