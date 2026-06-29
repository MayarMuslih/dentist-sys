<?php

namespace App\Filament\Widgets;

use App\Models\Clinic;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuperAdminStats extends BaseWidget
{
    // هي الدالة بتخلي الويدجت يظهر بس للمدير العام
    public static function canView(): bool
    {
        return auth()->user()->clinic_id === null;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('Total Clinics'), Clinic::count())
                ->icon('heroicon-o-building-office-2')
                ->color('primary'),

            Stat::make(__('Total Doctors'), User::whereNotNull('clinic_id')->count())
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }
}
