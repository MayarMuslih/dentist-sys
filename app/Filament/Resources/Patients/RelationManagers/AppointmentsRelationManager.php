<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    // إجبار فيلامينت على تفعيل الأزرار حتى داخل صفحة View
    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('clinic_id')
                    ->default(fn () => auth()->user()->clinic_id),

                Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'scheduled' => __('Scheduled'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                    ])
                    ->default('scheduled')
                    ->required()
                    ->native(false),

                DatePicker::make('appointment_date')
                    ->label(__('Appointment Date'))
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->default(now()->toDateString())
                    ->afterStateHydrated(function (DatePicker $component, $record) {
                        if ($record && $record->starts_at) {
                            $component->state($record->starts_at->toDateString());
                        }
                    })
                    ->dehydrated(false)
                    ->required(),

                TimePicker::make('starts_at')
                    ->label(__('Appointment Time'))
                    ->native(true)
                    ->seconds(false)
                    ->default('16:00')
                    ->afterStateHydrated(function (TimePicker $component, $record) {
                        if ($record && $record->starts_at) {
                            $component->state($record->starts_at->format('H:i'));
                        }
                    })
                    ->dehydrateStateUsing(function ($state, $get) {
                        $date = $get('appointment_date') ?? now()->toDateString();

                        return Carbon::parse("{$date} {$state}")->format('Y-m-d H:i:s');
                    })
                    ->required(),

                Textarea::make('notes')
                    ->label(__('Notes / Visit Reason'))
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('starts_at')
            ->defaultSort('starts_at', 'desc')
            ->columns([
                TextColumn::make('starts_at')
                    ->label(__('Date & Time'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable(),

                // شارة ملونة مع إمكانية الضغط عليها لتغيير الحالة فوراً
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
                    ->toggleable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(__('New Appointment')),
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
