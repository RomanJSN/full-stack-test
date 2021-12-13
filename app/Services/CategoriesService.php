<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;

class CategoriesService
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getCategories()
    {
        return $this->categoriesRepository->getCategories();
    }
}
