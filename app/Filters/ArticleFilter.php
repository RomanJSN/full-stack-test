<?php

namespace App\Filters;

class ArticleFilter extends QueryFilter
{
    public function categories(string $categories)
    {
        $categories = array_map('intval', explode(',', $categories));
        $this->builder->whereIn('articles_categories.category_id', $categories);
    }

    public function content(string $content)
    {
        $this->builder->where('content', 'like', "%{$content}%");
    }

    public function title(string $title)
    {
        $this->builder->where('title', 'like', "%{$title}%");
    }
}
