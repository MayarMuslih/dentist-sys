<?php

namespace App\Filament\Resources\Treatments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TreatmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name')
                    ->label('اسم المريض')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('service.name')
                    ->label('الخدمة المقدمة')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('tooth_number')
                    ->label('رقم السن')
                    ->searchable()
                    ->placeholder('غير محدد'),


                TextColumn::make('cost')
                    ->label('التكلفة')
                    ->money('SYP')
                    ->sortable()
                    ->color('success'),

                // تاريخ الجلسة
                TextColumn::make('treatment_date')
                    ->label('تاريخ الجلسة')
                    ->date('Y-m-d')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('آخر تحديث')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
