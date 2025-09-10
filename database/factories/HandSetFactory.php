<?php

namespace Database\Factories;

use App\Models\HandSet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HandSet>
 */
class HandSetFactory extends Factory
{
    protected $model = HandSet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brand = $this->faker->randomElement(['Apple', 'Samsung', 'Google', 'OnePlus', 'Sony']);
        $features = ['5G', 'Bluetooth', 'NFC', 'Dual SIM', 'Wireless Charging'];

        return [
            'name' => $this->faker->word() . ' ' . $this->faker->randomNumber(2),
            'brand' => $brand,
            'price' => $this->faker->randomFloat(2, 100, 2000),
            'release_date' => $this->faker->date(),
            'features' => $this->faker->randomElements(
                $features,
                $this->faker->numberBetween(1, count($features))
            ),
        ];
    }
}
