<?php

namespace App\Filters;

class ArticleFilter extends QueryFilter
{
    /**
     * @param string $categories
     * @return void
     */
    public function categories(string $categories)
    {
        $categories = array_map('intval', explode(',', $categories));
        $this->builder->whereIn('articles_categories.category_id', $categories);
    }

    /**
     * @param string $content
     * @return void
     */
    public function contentOrTitle(string $content)
    {
        $this->builder->where(function($query) use ($content) {
            $query->where('content', 'like', "%{$content}%");
            $query->orWhere('title', 'like', "%{$content}%");
        });
    }
}
