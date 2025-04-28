<?php

namespace Tests\Unit;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Article::factory()->count(3)->create();

        $response = $this->getJson(route('articles.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'price', 'barcode', 'category_id', 'created_at']
                ]
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_store_200()
    {
        $payload = array_filter(Article::factory()->make()->toArray(), fn($k) => in_array($k, ['name', 'price', 'barcode', 'category_id']), ARRAY_FILTER_USE_KEY);

        $response = $this->postJson(route('articles.store'), $payload);

        $response
            ->assertStatus(201);

        $this->assertDatabaseHas(Article::class, $payload);
    }



    public function test_store_200_2()
    {
        $payload = array_filter(Article::factory()->make()->toArray(), fn($k) => in_array($k, ['name', 'price', 'category_id']), ARRAY_FILTER_USE_KEY);

        $response = $this->postJson(route('articles.store'), $payload);

        $response
            ->assertStatus(201);

        $this->assertDatabaseHas(Article::class, $payload);
    }

    public function test_store_422()
    {
        $payload = Article::factory()->make()->toArray();

        $response = $this->postJson(route('articles.store'));

        $response
            ->assertStatus(422);

        $this->assertDatabaseMissing(Article::class, array_filter($payload, fn($k) => in_array($k, ['name', 'price', 'barcode', 'category_id']), ARRAY_FILTER_USE_KEY));
    }

    public function test_show_200()
    {
        $model = Article::factory()->create();

        $response = $this->getJson(route('articles.show', $model->id));

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'price', 'barcode', 'category_id', 'created_at']]);
    }

    public function test_show_404()
    {
        $response = $this->getJson(route('articles.show', 1));

        $response
            ->assertStatus(404);
    }

    public function test_update_200()
    {
        $model = Article::factory()->create(['name' => 'no test']);

        $payload = [
            'name' => 'test',
        ];
        $this->assertDatabaseMissing(Article::class, $payload);

        $response = $this->putJson(route('articles.update', $model->id), $payload);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'price', 'barcode', 'category_id', 'created_at']]);

        $this->assertDatabaseHas(Article::class, $payload);
    }

    public function test_update_404()
    {
        $payload = Article::factory()->make()->toArray();
        $response = $this->putJson(route('articles.update', 1), $payload);

        $response
            ->assertStatus(404);
    }

    public function test_delete_200()
    {
        $model = Article::factory()->create();

        $this->assertDatabaseCount(Article::class, 1);

        $response = $this->deleteJson(route('articles.destroy', $model->id));

        $response
            ->assertStatus(200);

        $this->assertDatabaseCount(Article::class, 0);
    }

    public function test_delete_404()
    {
        $response = $this->deleteJson(route('articles.destroy', 1));

        $response
            ->assertStatus(404);
    }
}

