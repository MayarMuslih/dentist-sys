<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name')
                    ->label(__('Patient Name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label(__('Paid Amount'))
                    ->money('SYP') // تنسيق العملة
                    ->sortable()
                    ->color('success'), // لون أخضر للمصاري

                // طريقة الدفع مع تصميم Badge ملون
                TextColumn::make('payment_method')
                    ->label(__('Payment Method'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => __('Cash'),
                        // 'credit_card' => 'بطاقة بنكية',
                        // 'transfer' => 'تحويل بنكي',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        // 'credit_card' => 'warning',
                        // 'transfer' => 'info',
                        default => 'primary',
                    }),

                TextColumn::make('payment_date')
                    ->label(__('Payment Date'))
                    ->date('Y-m-d')
                    ->sortable(),

                // الملاحظات (مخفية افتراضياً لحتى ما تاخد مساحة، بس بيقدر يظهرها)
                TextColumn::make('notes')
                    ->label(__('Notes'))
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
