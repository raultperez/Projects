<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->country,
            'user_id' => User::factory()->create([
                'name' => $this->faker->company,
                'email' => $this->faker->unique()->safeEmail,
                'password' => bcrypt('12345'),
                'isAdmin' => 0,
                'description' => $this->faker->paragraph(2)
            ])
        ];
    }
}
