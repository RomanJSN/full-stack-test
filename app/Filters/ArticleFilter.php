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
    public function content(string $content)
    {
        $this->builder->where('content', 'like', "%{$content}%");
    }

    /**
     * @param string $title
     * @return void
     */
    public function title(string $title)
    {
        $this->builder->where('title', 'like', "%{$title}%");
    }
}
