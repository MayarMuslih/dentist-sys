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
                    ->label(__('Patient Name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('service.name')
                    ->label(__('Provided Service'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tooth_number')
                    ->label(__('Tooth Number'))
                    ->searchable()
                    ->placeholder(__('Not Specified')),

                TextColumn::make('cost')
                    ->label(__('Cost'))
                    ->money('SYP')
                    ->sortable()
                    ->color('success'),

                // تاريخ الجلسة
                TextColumn::make('treatment_date')
                    ->label(__('Session Date'))
                    ->date('Y-m-d')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
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
