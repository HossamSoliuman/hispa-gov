<?php

namespace Database\Factories;

use App\Models\FishingTool;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FishingTool>
 */
class FishingToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(config('government.fishing_tool_options')).' '.fake()->unique()->numerify('##'),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
