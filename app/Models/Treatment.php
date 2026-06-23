<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'patient_id',
        'service_id',
        'tooth_number',
        'medical_notes',
        'cost',
        'paid_amount',
        'remaining_amount',
        'payment_status',
        'treatment_date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
