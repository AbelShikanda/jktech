<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Services extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categories_id',
        'type_id',
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'price',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the serviceType.
     */
    public function serviceType()
    {
        return $this->belongsToMany(ServiceTypes::class, 'service_service_types', 'services_id', 'service_types_id');
    }

    /**
     * Get the images.
     */
    public function serviceImage()
    {
        return $this->belongsToMany(ServiceImages::class, 'service_service_images', 'services_id', 'service_images_id');
    }

    /**
     * Get the Category.
     */
    public function Category()
    {
        return $this->belongsToMany(ServiceCategories::class, 'service_service_categories', 'services_id', 'service_categories_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services');
    }
}
