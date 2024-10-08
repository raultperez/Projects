<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->text(150),
            'price_hour' => $this->faker->numberBetween(10,30),
            'professional_id' => Professional::factory(),
            'category_id' => Category::factory()
        ];
    }
}
