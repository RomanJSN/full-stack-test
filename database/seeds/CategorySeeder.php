<?php

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileJSON = json_decode(file_get_contents(storage_path('app/feed.json')), true);
        $categoriesCollection = collect($fileJSON)
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

        Categories::insert($categoriesCollection);
    }
}
