<?php

namespace App\Services;

use App\Filters\ArticleFilter;
use App\Formatters\ArticlesFormatter;
use App\Repositories\ArticlesRepository;
use Illuminate\Database\Eloquent\Collection;

class ArticlesService
{
    protected $articlesRepository;
    protected $articlesFormatter;

    /**
     * @param ArticlesRepository $articlesRepository
     * @param ArticlesFormatter $articlesFormatter
     */
    public function __construct(ArticlesRepository $articlesRepository, ArticlesFormatter $articlesFormatter)
    {
        $this->articlesRepository = $articlesRepository;
        $this->articlesFormatter = $articlesFormatter;
    }

    /**
     * @param ArticleFilter $filter
     * @return Collection
     */
    public function getArticles(ArticleFilter $filter): Collection
    {
        return $this->articlesFormatter->getArticlesFormat(
            $this->articlesRepository->getArticles($filter)
        );
    }
}
