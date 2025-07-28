<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bundle_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function isActive()
    {
        return $this->status === 'active' && now()->between($this->start_date, $this->end_date);
    }
}
