<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KnowledgeBases extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'knowledgeBase_categories_id',
        'title',
        'sub_title',
        'body',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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
     * Get the images.
     */
    public function knowledgeBaseImage()
    {
        return $this->belongsToMany(KnowledgeBaseImages::class, 'knowledgeBase_knowledgeBase_images', 'knowledgeBases_id', 'knowledgeBase_images_id');
    }

    /**
     * Get the Category.
     */
    public function knowledgeBaseCategories()
    {
        return $this->belongsToMany(KnowledgeBaseCategories::class, 'knowledgeBase_knowledgeBase_categories', 'knowledgeBases_id', 'knowledgeBase_categories_id');
    }

    /**
     * Get the comments.
     */
    // public function comments()
    // {
    //     return $this->hasMany(Comments::class, 'knowledgeBase_id');
    // }
}
