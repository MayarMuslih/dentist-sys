<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Models\Payment;
use App\Models\Treatment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // الإحصائية الأولى: إجمالي المرضى
            Stat::make(__('Total Patients'), Patient::count())
                ->description(__('All registered patients'))
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            // الإحصائية الثانية: جلسات اليوم
            Stat::make(__('Today\'s Treatments'), Treatment::whereDate('treatment_date', today())->count())
                ->description(__('Sessions scheduled for today'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            // الإحصائية الثالثة: إجمالي الإيرادات المقبوضة
            Stat::make(__('Total Revenue'), number_format(Payment::sum('amount')).' SYP')
                ->description(__('All time payments'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
