<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'default_price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
