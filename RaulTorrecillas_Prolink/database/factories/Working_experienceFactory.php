<?php

namespace Database\Factories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Working_experience>
 */
class Working_experienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'begins_at' => $this->faker->date('Y-m-d'),
            'company_name' => $this->faker->company,
            'description' => $this->faker->text(150),
            'professional_id' => Professional::factory()
        ];
    }
}
