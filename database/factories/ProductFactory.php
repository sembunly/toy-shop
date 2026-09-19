<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Building Blocks', 'Plush Bear', 'Remote Control Car', 'Art Set', 'Puzzle Game',
        ]);

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->value('id'),
            'name' => $name,
            'sku' => strtoupper($this->faker->unique()->bothify('TOY-####')),
            'brand' => $this->faker->company(),
            'price' => $this->faker->randomFloat(2, 5, 250),
            'cost_price' => $this->faker->randomFloat(2, 2, 150),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => null,
            'description' => $this->faker->sentence(12),
            'status' => true,
            'is_active' => true,
        ];
    }
}
