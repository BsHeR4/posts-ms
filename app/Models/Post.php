<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'meta_description',
        'tags',
        'keywords'
    ];

    protected $casts = [
        'tags' => 'array',
        'keywords' => 'array',
    ];

    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopeTags($query, $tags)
    {
        foreach ($tags as $tag) {
            $query->whereJsonContains('tags', $tag);
        }
    
        return $query;
    }

}
