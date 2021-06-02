<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['red','blue','green','yellow','orange', 'aqua', 'azure', 'gray', 'dark', 'white'];
        foreach($colors as $color){
            DB::table('product_colors')->insert([
                'name' => $color,
            ]);
        }
        
    }
}
