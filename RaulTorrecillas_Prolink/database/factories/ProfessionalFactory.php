<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional>
 */
class ProfessionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'surname' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18,60),
            'user_id' => User::factory()->create([
                'name' => $this->faker->firstName,
                'email' => $this->faker->unique()->safeEmail,
                'password' => bcrypt('12345'),
                'isAdmin' => 0,
                'description' => $this->faker->paragraph(2)
            ])
        ];
    }
}
