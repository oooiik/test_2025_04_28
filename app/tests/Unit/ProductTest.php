<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson(route('products.index'));

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
        $payload = array_filter(Product::factory()->make()->toArray(), fn($k) => in_array($k, ['name', 'price', 'barcode', 'category_id']), ARRAY_FILTER_USE_KEY);

        $response = $this->postJson(route('products.store'), $payload);

        $response
            ->assertStatus(201);

        $this->assertDatabaseHas(Product::class, $payload);
    }



    public function test_store_200_2()
    {
        $payload = array_filter(Product::factory()->make()->toArray(), fn($k) => in_array($k, ['name', 'price', 'category_id']), ARRAY_FILTER_USE_KEY);

        $response = $this->postJson(route('products.store'), $payload);

        $response
            ->assertStatus(201);

        $this->assertDatabaseHas(Product::class, $payload);
    }

    public function test_store_422()
    {
        $payload = Product::factory()->make()->toArray();

        $response = $this->postJson(route('products.store'));

        $response
            ->assertStatus(422);

        $this->assertDatabaseMissing(Product::class, array_filter($payload, fn($k) => in_array($k, ['name', 'price', 'barcode', 'category_id']), ARRAY_FILTER_USE_KEY));
    }

    public function test_show_200()
    {
        $model = Product::factory()->create();

        $response = $this->getJson(route('products.show', $model->id));

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'price', 'barcode', 'category_id', 'created_at']]);
    }

    public function test_show_404()
    {
        $response = $this->getJson(route('products.show', 1));

        $response
            ->assertStatus(404);
    }

    public function test_update_200()
    {
        $model = Product::factory()->create(['name' => 'no test']);

        $payload = [
            'name' => 'test',
        ];
        $this->assertDatabaseMissing(Product::class, $payload);

        $response = $this->putJson(route('products.update', $model->id), $payload);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'price', 'barcode', 'category_id', 'created_at']]);

        $this->assertDatabaseHas(Product::class, $payload);
    }

    public function test_update_404()
    {
        $payload = Product::factory()->make()->toArray();
        $response = $this->putJson(route('products.update', 1), $payload);

        $response
            ->assertStatus(404);
    }

    public function test_delete_200()
    {
        $model = Product::factory()->create();

        $this->assertDatabaseCount(Product::class, 1);

        $response = $this->deleteJson(route('products.destroy', $model->id));

        $response
            ->assertStatus(200);

        $this->assertDatabaseCount(Product::class, 0);
    }

    public function test_delete_404()
    {
        $response = $this->deleteJson(route('products.destroy', 1));

        $response
            ->assertStatus(404);
    }
}

