<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // القسم الأول: معلومات المريض الأساسية
                Section::make(__('Patient Details'))
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Patient Name')),

                        TextEntry::make('phone')
                            ->label(__('Phone Number')),

                        TextEntry::make('age')
                            ->label(__('Age')),

                        TextEntry::make('gender')
                            ->label(__('Gender'))
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'male' => __('Male'),
                                'female' => __('Female'),
                                default => $state,
                            }),
                    ])->columns(2),

                // القسم الثاني: الحسبة المالية الشاملة
                Section::make(__('Financial Summary'))
                    ->schema([
                        // 1. إجمالي العلاجات (تكلفة)
                        TextEntry::make('total_cost')
                            ->label(__('Total Treatments Cost'))
                            ->state(fn ($record) => $record->treatments->sum('cost'))
                            ->money('SYP')
                            ->color('gray'),

                        // 2. إجمالي الدفعات
                        TextEntry::make('total_paid')
                            ->label(__('Total Payments'))
                            ->state(fn ($record) => $record->payments->sum('amount'))
                            ->money('SYP')
                            ->color('gray'),

                        // 3. الرصيد المتبقي الجاهز
                        TextEntry::make('balance')
                            ->label(__('Remaining Balance'))
                            ->money('SYP')
                            ->badge()
                            ->color(fn (float $state): string => $state > 0 ? 'danger' : 'success'),
                    ])->columns(3),
            ]);
    }
}
