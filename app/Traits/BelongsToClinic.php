<?php

namespace App\Traits;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToClinic
{
    public static function bootBelongsToClinic(): void
    {
        static::addGlobalScope('clinic', function (Builder $builder): void {
            if (auth()->check() && auth()->user()->clinic_id) {
                $builder->where($builder->getModel()->getTable().'.clinic_id', auth()->user()->clinic_id);
            }
        });

        static::creating(function ($model): void {
            if (auth()->check() && auth()->user()->clinic_id && empty($model->clinic_id)) {
                $model->clinic_id = auth()->user()->clinic_id;
            }
        });
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}
