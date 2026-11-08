<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KnowledgeBaseCategories extends Model
{
    use HasFactory;

    protected $table = 'knowledge_base_categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if (empty($category->slug) && !empty($category->name)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function knowledgeBases()
    {
        return $this->belongsToMany(KnowledgeBases::class, 'knowledge_knowledge_base_categories', 'kBase_categories_id', 'knowledgeBases_id');
    }
}
