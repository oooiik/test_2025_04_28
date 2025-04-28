<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson(route('categories.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'created_at']
                ]
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_store_201()
    {
        $payload = [
            'name' => 'test',
        ];

        $response = $this->postJson(route('categories.store'), $payload);

        $response
            ->assertStatus(201);

        $this->assertDatabaseHas(Category::class, $payload);
    }

    public function test_store_422()
    {
        $payload = [
            'name' => 'test',
        ];

        $response = $this->postJson(route('categories.store'));

        $response
            ->assertStatus(422);

        $this->assertDatabaseMissing(Category::class, $payload);
    }

    public function test_show_200()
    {
        $model = Category::factory()->create();

        $response = $this->getJson(route('categories.show', $model->id));

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'created_at']]);
    }

    public function test_show_404()
    {
        $response = $this->getJson(route('categories.show', 1));

        $response
            ->assertStatus(404);
    }

    public function test_update_200()
    {
        $model = Category::factory()->create(['name' => 'no test']);

        $payload = [
            'name' => 'test',
        ];
        $this->assertDatabaseMissing(Category::class, $payload);

        $response = $this->putJson(route('categories.update', $model->id), $payload);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'created_at']]);

        $this->assertDatabaseHas(Category::class, $payload);
    }

    public function test_update_422()
    {
        $model = Category::factory()->create(['name' => 'no test']);

        $payload = [
            'name' => 'test',
        ];
        $this->assertDatabaseMissing(Category::class, $payload);

        $response = $this->putJson(route('categories.update', $model->id));

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ['name'],
                'message'
            ]);

        $this->assertDatabaseMissing(Category::class, $payload);
    }

    public function test_update_404()
    {
        $payload = [
            'name' => 'test',
        ];
        $response = $this->putJson(route('categories.update', 1), $payload);

        $response
            ->assertStatus(404);
    }

    public function test_delete_200()
    {
        $model = Category::factory()->create();

        $this->assertDatabaseCount(Category::class, 1);

        $response = $this->deleteJson(route('categories.destroy', $model->id));

        $response
            ->assertStatus(200);

        $this->assertDatabaseCount(Category::class, 0);
    }

    public function test_delete_404()
    {
        $response = $this->deleteJson(route('categories.destroy', 1));

        $response
            ->assertStatus(404);
    }
}

