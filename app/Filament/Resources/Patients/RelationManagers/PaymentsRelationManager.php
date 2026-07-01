<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public static function getModelLabel(): string
    {
        return __('Payment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Payments');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label(__('Amount'))
                    ->required()
                    ->numeric(),

                TextInput::make('payment_method')
                    ->label(__('Payment Method'))
                    ->required()
                    ->default('cash'),

                DatePicker::make('payment_date')
                    ->label(__('Date'))
                    ->required()
                    ->default(now()),

                Textarea::make('notes')
                    ->label(__('Notes'))
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('amount')
                    ->label(__('Amount'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label(__('Payment Method'))
                    ->searchable(),

                TextColumn::make('payment_date')
                    ->label(__('Date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->after(fn (\Livewire\Component $livewire) => $livewire->dispatch('refresh-patient')),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(fn (\Livewire\Component $livewire) => $livewire->dispatch('refresh-patient')),
                DeleteAction::make()
                    ->after(fn (\Livewire\Component $livewire) => $livewire->dispatch('refresh-patient')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(fn (\Livewire\Component $livewire) => $livewire->dispatch('refresh-patient')),
                ]),
            ]);
    }
}
