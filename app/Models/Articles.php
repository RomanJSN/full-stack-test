<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use Filterable;

    public const CREATED_AT = 'published';
    public const UPDATED_AT = 'modified';
    public const WITH_MEDIA = 'media';
    public const WITH_CATEGORIES_RELATION = 'categoriesRelation';

    protected $table = 'articles';

    protected $hidden = ['categoriesRelation'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'published',
        'modified'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function media()
    {
        return $this->belongsToMany(
            Media::class,
            'articles_media',
            'article_id',
            'media_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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
