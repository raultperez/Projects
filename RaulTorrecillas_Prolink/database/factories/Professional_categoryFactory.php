<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional_category>
 */
class Professional_categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'professional_id' => Professional::factory(),
            'category_id' => Category::factory()
        ];
    }
}
