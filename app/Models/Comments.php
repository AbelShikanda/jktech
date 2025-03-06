<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    // protected $fillable = ['knowledgeBase_id', 'user_id', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'knowledgeBase_id',
        'user_id',
        'content',
    ];

    public function knowledgeBase()
    {
        return $this->belongsTo(KnowledgeBases::class, 'knowledgeBase_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
