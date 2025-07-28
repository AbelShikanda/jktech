<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'software_id',
        'os',  // e.g., windows, mac, linux, kali
        'version',
        'download_url',
    ];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
