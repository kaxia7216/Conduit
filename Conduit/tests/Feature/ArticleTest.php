<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testSample(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testShowArticle()
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
    }
}
