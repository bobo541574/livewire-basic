<?php

namespace Database\Factories;

use App\Models\Containent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->country,
            'containent_id' => fake()->randomElement(Containent::pluck('id')->toArray())
        ];
    }
}
