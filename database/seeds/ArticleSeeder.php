<?php

use Illuminate\Database\Seeder;
use App\Models\Articles;
use App\Models\Categories;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileJSON = json_decode(file_get_contents(storage_path('app/feed.json')), true);
        $categoriesDB = Categories::get();
        $media = Media::get();
        foreach ($fileJSON as $articles) {
            $articleId = Articles::insertGetId([
                'title' => $articles['title'],
                'slug' => $articles['slug'],
                'content' => $articles['content'][0]['content'],
                'status' => $articles['properties']['status'],
                'published' => date('Y-m-d H:s:i', strtotime($articles['properties']['published'])),
                'modified' => date('Y-m-d H:s:i', strtotime($articles['properties']['modified'])),
            ]);

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

            DB::table('articles_categories')->insert($categories);
            if (count($articles['media']) && $mediaId = $media->where('slug', $articles['media'][0]['media']['slug'])->pluck('id')->first()) {
                DB::table('articles_media')->insert([
                    'article_id' => $articleId,
                    'media_id' => $mediaId
                ]);
            }
        }
    }
}
