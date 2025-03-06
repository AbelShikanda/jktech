<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail',
        'full',
        'services_id',
    ];

    /**
     * Get the images.
     */
    public function services()
    {
        return $this->belongsToMany(Services::class, 'service_service_images', 'service_images_id', 'services_id');
    }
}
