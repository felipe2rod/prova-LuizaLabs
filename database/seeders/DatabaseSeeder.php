<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientsSeeder::class,
            ColorsSeeder::class,
            SizesSeeder::class,
            ProductSeeder::class
        ]);
    }
}
