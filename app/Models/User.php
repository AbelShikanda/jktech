<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'gender',
        'phone',
        'town',
        'location',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship: User has many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(
            MpesaPayment::class,  // Final model
            Booking::class,  // Intermediate model
            'user_id',  // Foreign key on Booking table
            'booking_id',  // Foreign key on MpesaPayment table
            'id',  // Local key on User table
            'id'  // Local key on Booking table
        );
    }

    public function subscriptions()
    {
        return $this->hasMany(UserBundle::class);
    }

    public function mpesaPayments()
    {
        return $this->hasMany(MpesaPayment::class);
    }
}
