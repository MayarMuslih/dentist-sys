<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'age',
        'gender',
        'medical_history'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
