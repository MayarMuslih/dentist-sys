<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Appointment Details'))
                    ->schema([
                        Hidden::make('clinic_id')
                            ->default(fn () => auth()->user()->clinic_id),

                        Select::make('patient_id')
                            ->label(__('Patient'))
                            ->relationship(
                                name: 'patient',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('clinic_id', auth()->user()->clinic_id)
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('Patient Name'))
                                    ->required(),
                                TextInput::make('phone')
                                    ->label(__('Phone Number'))
                                    ->tel(),
                            ]),

                        // الحالات المختصرة
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

                        // 1. تقويم مخصص لاختيار اليوم فقط
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
                            ->dehydrated(false) // لا يتم حفظه كعمود منفصل
                            ->required(),

                        // 2. ساعة مخصصة لاختيار الوقت مع AM/PM
                        TimePicker::make('starts_at')
                            ->label(__('Appointment Time'))
                            ->seconds(false)
                            ->native(true) // يستخدم منتقي المتصفح/النظام المباشر الداعم لـ AM/PM والنقر السريع
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
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
