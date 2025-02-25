<?php

namespace App\Formatters;

use Illuminate\Database\Eloquent\Collection;

class ArticlesFormatter
{
    /**
     * @param Collection $articlesCollection
     * @return Collection|\Illuminate\Support\Collection
     */
    public function getArticlesFormat(Collection $articlesCollection)
    {
        return $articlesCollection->map(function ($article) {
            $article->categories = [
                'primary' => $article->categoriesRelation->where('type', 'primary')->pluck('name')->first(),
                'additional' => $article->categoriesRelation->where('type', 'additional')->pluck('name')->toArray()
            ];

            return $article;
        });
    }
}
