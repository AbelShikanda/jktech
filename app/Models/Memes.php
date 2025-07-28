<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memes extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'description',
        'image',
    ];
}
