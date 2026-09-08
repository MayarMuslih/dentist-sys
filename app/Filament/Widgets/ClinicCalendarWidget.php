<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Appointments\AppointmentResource;
use App\Models\Appointment;
use Carbon\WeekDay;
use Guava\Calendar\Filament\CalendarWidget;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Guava\Calendar\ValueObjects\EventClickInfo;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ClinicCalendarWidget extends CalendarWidget
{
    protected int | string | array $columnSpan = 'full';

    protected WeekDay $firstDay = WeekDay::Sunday;

    protected array $options = [
        'headerToolbar' => [
            'start' => 'prev,next today',
            'center' => 'title',
            'end' => 'dayGridMonth,timeGridWeek,timeGridDay',
        ],
    ];

    protected function getEvents(FetchInfo $info): array | Collection
    {
        return Appointment::query()
            ->where('clinic_id', auth()->user()->clinic_id)
            ->whereBetween('starts_at', [$info->start, $info->end])
            ->with('patient')
            ->get()
            ->map(function (Appointment $appointment) {
                $color = match ($appointment->status) {
                    'scheduled' => '#2563eb', // أزرق
                    'completed' => '#16a34a', // أخضر
                    'cancelled' => '#dc2626', // أحمر
                    default => '#4b5563',
                };

                return CalendarEvent::make($appointment)
                    ->title($appointment->patient?->name ?? __('Unknown Patient'))
                    ->start($appointment->starts_at)
                    ->end($appointment->starts_at->copy()->addMinutes(30))
                    ->backgroundColor($color);
            })
            ->toArray();
    }

    protected function onEventClick(EventClickInfo $info, Model $event, ?string $action = null): void
    {
        $this->redirect(AppointmentResource::getUrl('edit', ['record' => $event]));
    }
}
