<?php

namespace App\Models;

use App\Traits\BelongsToClinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use BelongsToClinic;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'age',
        'gender',
        'medical_history',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // علاقة المريض مع علاجاته
    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    // علاقة المريض مع دفعاته
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getBalanceAttribute(): float
    {
        $totalCost = $this->treatments->sum('cost');
        $totalPaid = $this->payments->sum('amount');

        return $totalCost - $totalPaid;
    }
}
