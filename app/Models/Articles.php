<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    public const CREATED_AT = 'published';
    public const UPDATED_AT = 'modified';
    protected $hidden = ['categoriesRelation'];
    public const WITH_MEDIA = 'media';
    public const WITH_CATEGORIES_RELATION = 'categoriesRelation';

    public function media()
    {
        return $this->belongsToMany(
            Media::class,
            'articles_media',
            'article_id',
            'media_id'
        );
    }

    public function categoriesRelation()
    {
        return $this->belongsToMany(
            Categories::class,
            'articles_categories',
            'article_id',
            'category_id',
        )->select(['id', 'name', 'type']);
    }
}
