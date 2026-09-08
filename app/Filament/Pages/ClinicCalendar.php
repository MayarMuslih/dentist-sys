<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ClinicCalendarWidget;
use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class ClinicCalendar extends Page
{
    protected static ?string $navigationLabel = 'Calendar';

    protected static string | UnitEnum | null $navigationGroup = 'Clinic Management';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.clinic-calendar';

    protected function getHeaderWidgets(): array
    {
        return [
            ClinicCalendarWidget::class,
        ];
    }
}
