<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('clinic_id', auth()->user()->clinic_id)->with(['patient']))
            ->defaultSort('starts_at', 'asc')
            ->columns([
                TextColumn::make('patient.name')
                    ->label(__('Patient'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patient.phone')
                    ->label(__('Phone'))
                    ->searchable()
                    ->toggleable(),

                // عرض التاريخ والوقت بوضوح بنظام 12 ساعة
                TextColumn::make('starts_at')
                    ->label(__('Date & Time'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable(),

                // الشارة الملونة مع نافذة تعديل سريعة عند النقر عليها
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'scheduled' => __('Scheduled'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->action(
                        Action::make('changeStatus')
                            ->modalHeading(__('Update Status'))
                            ->modalWidth('sm')
                            ->fillForm(fn ($record): array => [
                                'status' => $record->status,
                            ])
                            ->schema([
                                Select::make('status')
                                    ->label(__('Status'))
                                    ->options([
                                        'scheduled' => __('Scheduled'),
                                        'completed' => __('Completed'),
                                        'cancelled' => __('Cancelled'),
                                    ])
                                    ->required()
                                    ->native(false),
                            ])
                            ->action(function ($record, array $data): void {
                                $record->update(['status' => $data['status']]);
                            })
                    ),

                TextColumn::make('notes')
                    ->label(__('Notes'))
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options([
                        'scheduled' => __('Scheduled'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
