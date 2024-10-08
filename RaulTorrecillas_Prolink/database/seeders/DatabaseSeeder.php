<?php

namespace Database\Seeders;

use App\Models\Cart_proposal;
use App\Models\Company;
use App\Models\Order;
use App\Models\Order_proposal;
use App\Models\Professional;
use App\Models\Professional_category;
use App\Models\Proposal;
use App\Models\Proposal_category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Working_experience;
use Database\Factories\Order_proposalFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'pepe',
            'email' => 'pepe@pepe.com',
            'password' => bcrypt('12345'),
            'isAdmin' => 1
        ]);

        Professional_category::factory(5)->create();

        Cart_proposal::factory(5)->create();

        for ($i = 1 ; $i <= 5 ; $i++){
            Proposal::factory()->create([
                'professional_id' => $i,
                'category_id' => $i
            ]);
        }

        for ($i = 1 ; $i <= 5 ; $i++){
            Working_experience::factory()->create([
                'professional_id' => $i
            ]);
        }
    }
}
