<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AtrisanImportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticlesDataUpload()
    {
        $response = $this->post('/api/articles/import', [
            'file' => UploadedFile::fake()->create('feed.json')
        ]);

        $response->assertStatus(204);
    }
}
