<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory()
            ->has(
                Order::factory()
                ->has(
                    OrderItem::factory()
                    ->count(5)
                )
                ->count(3))
            ->count(50)
            ->create();
    }
}
