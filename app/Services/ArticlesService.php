<?php

namespace App\Services;

use App\Formatters\ArticlesFormatter;
use App\Repositories\ArticlesRepository;
use Illuminate\Database\Eloquent\Collection;

class ArticlesService
{
    protected $articlesRepository;
    protected $articlesFormatter;

    public function __construct(ArticlesRepository $articlesRepository, ArticlesFormatter $articlesFormatter)
    {
        $this->articlesRepository = $articlesRepository;
        $this->articlesFormatter = $articlesFormatter;
    }

    public function getArticles(array $inputField): Collection
    {
        return $this->articlesFormatter->getArticlesFormat(
            $this->articlesRepository->getArticles($inputField)
        );
    }
}
