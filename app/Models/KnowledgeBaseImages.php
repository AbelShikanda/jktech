<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeBaseImages extends Model
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
        'knowledgeBases_id',
    ];

    /**
     * Get the knowledgeBases.
     */
    public function knowledgeBases()
    {
        return $this->belongsToMany(KnowledgeBases::class, 'knowledgeBase_knowledgeBase_images', 'knowledgeBase_images_id', 'knowledgeBases_id');
    }
}
