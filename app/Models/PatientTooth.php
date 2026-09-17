<?php

namespace App\Models;

use App\Traits\BelongsToClinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientTooth extends Model
{
    use BelongsToClinic;

    public const STATUS_HEALTHY = 'healthy';

    public const STATUS_DECAY = 'decay';

    public const STATUS_FILLED = 'filled';

    public const STATUS_MISSING = 'missing';

    public const STATUS_ROOT_CANAL = 'root_canal';

    public const STATUS_CROWN = 'crown';

    public const STATUS_IMPLANT = 'implant';

    protected $attributes = [
        'status' => self::STATUS_HEALTHY,
    ];

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'tooth_number',
        'status',
        'notes',
    ];

    public static function statusOptions(): array
    {
        return [
            self::STATUS_HEALTHY => 'Healthy',
            self::STATUS_DECAY => 'Decay',
            self::STATUS_FILLED => 'Filled',
            self::STATUS_MISSING => 'Missing',
            self::STATUS_ROOT_CANAL => 'Root Canal',
            self::STATUS_CROWN => 'Crown',
            self::STATUS_IMPLANT => 'Implant',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function statusColor(): string
    {
        return [
            self::STATUS_HEALTHY => 'green',
            self::STATUS_DECAY => 'red',
            self::STATUS_FILLED => 'blue',
            self::STATUS_MISSING => 'gray',
            self::STATUS_ROOT_CANAL => 'purple',
            self::STATUS_CROWN => 'amber',
            self::STATUS_IMPLANT => 'cyan',
        ][$this->status] ?? 'gray';
    }

    public function statusLabel(): string
    {
        return self::statusOptions()[$this->status] ?? str($this->status)->headline()->toString();
    }
}
