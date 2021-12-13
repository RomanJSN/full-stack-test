<?php

namespace App\Repositories;

use App\Filters\ArticleFilter;
use App\Models\Articles;
use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ArticlesRepository
{
    /**
     * @param ArticleFilter $filter
     * @return mixed
     */
    public function getArticles(ArticleFilter $filter)
    {
        $query = Articles::filter($filter)
            ->with([Articles::WITH_MEDIA, Articles::WITH_CATEGORIES_RELATION])
            ->join('articles_categories', 'articles_categories.article_id', 'articles.id')
            ->select('articles.*')
            ->groupBy('articles.id');

        return $query->get();
    }

    /**
     * @return Collection
     */
    public function getMedia(): Collection
    {
        return Media::get();
    }

    /**
     * @param array $articlesData
     * @return int
     */
    public function insertArticleGetId(array $articlesData): int
    {
        return Articles::insertGetId($articlesData);
    }

    /**
     * @param array $mediaCollection
     * @return void
     */
    public function insertMedia(array $mediaCollection)
    {
        Media::insert($mediaCollection);
    }

    /**
     * @param array $articlesCategories
     * @return void
     */
    public function insertArticlesCategories(array $articlesCategories)
    {
        DB::table('articles_categories')->insert($articlesCategories);
    }

    /**
     * @param array $articlesMedia
     * @return void
     */
    public function insertArticlesMedia(array $articlesMedia)
    {
        DB::table('articles_media')->insert($articlesMedia);
    }
}
