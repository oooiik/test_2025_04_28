<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->randomFloat(1, 0, 1000),
            'barcode' => $this->generateFakeEAN13(),
            'category_id' => Category::query()->inRandomOrder()->first()?->id ?? Category::factory()->create()->id
        ];
    }

    protected function generateFakeEAN13() {
        $code = [];
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $num = rand(0, 9);
            array_push($code, $num);
            $sum += (int)$num * ($i % 2 === 0 ? 1 : 3);
        }
        $checksum = (10 - ($sum % 10)) % 10;

        $n = implode('', $code) . $checksum;

        if (Product::query()->where('barcode', $n)->exists()) $n = $this->generateFakeEAN13();
        return $n;
    }
}
