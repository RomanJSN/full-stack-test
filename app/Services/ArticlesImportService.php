<?php

namespace App\Services;

use App\Repositories\ArticlesRepository;
use App\Repositories\CategoriesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ArticlesImportService
{
    private $articlesData;
    public $articlesRepository;
    public $categoriesRepository;

    /**
     * @param ArticlesRepository $articlesRepository
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(
        ArticlesRepository   $articlesRepository,
        CategoriesRepository $categoriesRepository
    )
    {
        $this->articlesRepository = $articlesRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getArticles()
    {
        return $this->articlesRepository->getArticles();
    }

    /**
     * @param string $articlesData
     * @return void
     */
    public function import(string $articlesData)
    {
        $this->articlesData = collect(json_decode($articlesData, true));
        DB::transaction(function () {
            $this->setCategories();
            $this->setMedia();
            $this->setArticles();
        });
    }

    /**
     * @return void
     */
    private function setCategories()
    {
        $categoriesCollection = $this->articlesData
            ->pluck('categories')
            ->map(function ($category) {
                return [$category['primary'], ...$category['additional']];
            })
            ->collapse()
            ->unique()
            ->filter()
            ->values()
            ->map(function ($category) {
                return ['name' => $category];
            })->toArray();

        $this->categoriesRepository->insertCategories($categoriesCollection);
    }

    /**
     * @return void
     */
    private function setMedia()
    {
        $mediaCollection = $this->articlesData
            ->pluck('media')
            ->collapse()
            ->map(function ($media) {
                return [
                    'source' => $media['media']['source'],
                    'slug' => $media['media']['slug'],
                    'type' => $media['media']['type'],
                    'url' => $media['media']['attributes']['url'],
                    'width' => $media['media']['attributes']['width'],
                    'height' => $media['media']['attributes']['height'],
                    'published' => date('Y-m-d H:s:i', strtotime($media['media']['properties']['published'])),
                    'modified' => date('Y-m-d H:s:i', strtotime($media['media']['properties']['modified']))
                ];
            })
            ->unique('slug')
            ->toArray();

        $this->articlesRepository->insertMedia($mediaCollection);
    }

    /**
     * @return void
     */
    private function setArticles()
    {
        $media = $this->articlesRepository->getMedia();
        $categoriesDB = $this->categoriesRepository->getCategories();
        foreach ($this->articlesData as $articles) {
            $articleId = $this->articlesRepository
                ->insertArticleGetId([
                    'title' => $articles['title'],
                    'slug' => $articles['slug'],
                    'content' => $articles['content'][0]['content'],
                    'status' => $articles['properties']['status'],
                    'published' => date('Y-m-d H:s:i', strtotime($articles['properties']['published'])),
                    'modified' => date('Y-m-d H:s:i', strtotime($articles['properties']['modified'])),
                ]);

            $this->setArticlesCategories($articleId, $articles, $categoriesDB);
            $this->setArticlesMedia($articleId, $articles, $media);
        }
    }

    /**
     * @param int $articleId
     * @param array $articles
     * @param Collection $categoriesDB
     * @return void
     */
    private function setArticlesCategories(int $articleId, array $articles, Collection $categoriesDB)
    {
        $categories = [];
        foreach ($articles['categories'] as $key => $category) {
            if (is_array($category) && !empty($category)) {
                foreach ($category as $value) {
                    $categories[] = [
                        'article_id' => $articleId,
                        'category_id' => $categoriesDB->where('name', $value)->pluck('id')->first(),
                        'type' => $key
                    ];
                }
                continue;
            }
            if ($idCat = $categoriesDB->where('name', $category)->pluck('id')->first()) {
                $categories[] = [
                    'article_id' => $articleId,
                    'category_id' => $idCat,
                    'type' => $key
                ];
            }
        }
        $this->articlesRepository->insertArticlesCategories($categories);
    }

    /**
     * @param int $articleId
     * @param array $articles
     * @param Collection $media
     * @return void
     */
    private function setArticlesMedia(int $articleId, array $articles, Collection $media)
    {
        if (empty($articles['media'])) return;

        foreach ($articles['media'] as $mediaInfo) {
            $mediaId = $media->where(
                'slug',
                $mediaInfo['media']['slug']
            )
                ->pluck('id')
                ->first();
            $this->articlesRepository->insertArticlesMedia([
                'article_id' => $articleId,
                'media_id' => $mediaId
            ]);
        }
    }
}
