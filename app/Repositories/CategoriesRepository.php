<?php

namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Collection;

class CategoriesRepository
{
  /**
   * @return Collection
   */
  public function getCategories(): Collection
  {
    return Categories::get();
  }

  /**
   * @param array $categoriesCollection
   * @return void
   */
  public function insertCategories(array $categoriesCollection)
  {
    Categories::insert($categoriesCollection);
  }
}
