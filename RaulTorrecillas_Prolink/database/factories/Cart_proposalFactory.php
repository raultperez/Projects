<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart_proposal>
 */
class Cart_proposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'n_hours' => $this->faker->numberBetween(0,10),
            'price' => $this->faker->numberBetween(1,50),
            'proposal_id' => Proposal::factory(),
            'cart_id' => Cart::factory()
        ];
    }
}
