<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;




class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = Color::all();
        $sizes = Size::all();

        for($i = 0; $i < 30; $i++){
            DB::table('products')->insert([
                'name' => Str::random(10),
                'price'=> (rand(10*10, 100*10) / 10)
            ]);
        }

        $clients = Product::all();

        $clients->each(function($client) use ($colors, $sizes){
            $client->colors()->attach(
                $colors->random(rand(1, 3))->pluck('id')->toArray()
            );
            $client->sizes()->attach(
                $sizes->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
