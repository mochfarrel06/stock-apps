<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // Sesuaikan dengan ID user yang ada di database
            'item_type_id' => $this->faker->randomElement([1, 2]),
            'unit_type_id' => $this->faker->randomElement([1, 2]),
            'name' => $this->faker->word(),
            'item_code' => $this->faker->unique()->numberBetween(1000, 9999),
            'reorder_level' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 10000),
            'photo' => $this->faker->imageUrl(640, 480, 'cats', true), // Menghasilkan URL gambar
        ];
    }
}
