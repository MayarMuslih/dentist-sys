<?php

namespace App\Filament\Resources\Patients\Tables;


use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['treatments', 'payments']))
            ->columns([
                TextColumn::make('name')
                    ->label(__('Patient Name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label(__('Phone Number'))
                    ->searchable(),

                TextColumn::make('age')
                    ->label(__('Age'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('gender')
                    ->label(__('Gender'))
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'male' => __('Male'),
                        'female' => __('Female'),
                        default => $state,
                    }),

                TextColumn::make('balance')
                    ->label(__('Balance'))
                    ->money('SYP')
                    ->badge()
                    ->color(fn (float $state): string => $state > 0 ? 'danger' : 'success')
                    ->sortable(false),

                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(), // صارت بالمركز الأول لتفتح الإضبارة فوراً
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
