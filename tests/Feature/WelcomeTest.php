<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
