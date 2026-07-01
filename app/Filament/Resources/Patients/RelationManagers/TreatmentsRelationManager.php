<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Service;
use Filament\Forms\Set;


class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public static function getModelLabel(): string
    {
        return __('Treatment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Treatments');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required()
                    ->searchable()
                    ->label(__('Provided Service'))
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $service = Service::find($state);
                            if ($service) {
                                $set('cost', $service->default_price);
                            }
                        }
                    }),

                TextInput::make('tooth_number')
                    ->label(__('Tooth Number')),

                Textarea::make('medical_notes')
                    ->label(__('Medical Notes'))
                    ->columnSpanFull(),

                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix(__('SYP'))
                    ->label(__('Final Cost')),

                DatePicker::make('treatment_date')
                    ->label(__('Date'))
                    ->default(now())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('service.name')
                    ->label(__('Service'))
                    ->searchable(),

                TextColumn::make('tooth_number')
                    ->label(__('Tooth Number'))
                    ->searchable(),

                TextColumn::make('cost')
                    ->label(__('Cost'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('treatment_date')
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
