<?php

use Illuminate\Database\Seeder;
use App\Models\Media;
use Carbon\Carbon;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileJSON = json_decode(file_get_contents(storage_path('app/feed.json')), true);

        $mediaCollection = collect($fileJSON)->pluck('media')->collapse()->map(function ($media) {
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
        })->unique('slug')->toArray();

        Media::insert($mediaCollection);
    }
}
