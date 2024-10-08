<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_proposal>
 */
class Order_proposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'proposal_id' => Proposal::factory(),
            'n_hours' => $this->faker->numberBetween(0,10),
            'price' => $this->faker->numberBetween(1,50)
        ];
    }
}
