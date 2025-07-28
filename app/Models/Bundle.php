<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_unit',
        'duration',
        'is_active',
        'is_recurring',
        'trial_days',
        'type',
        'features'
    ];

    protected $casts = [
        'features' => 'array',
        'is_recurring' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(UserBundle::class);
    }

    public function mpesaPayments()
    {
        return $this->hasMany(MpesaPayment::class);
    }
}
