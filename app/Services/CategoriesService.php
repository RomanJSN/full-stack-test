<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;

class CategoriesService
{
    protected $categoriesRepository;

    /**
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories()
    {
        return $this->categoriesRepository->getCategories();
    }
}
