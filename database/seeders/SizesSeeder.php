<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['p','m','g','gg','xxg'];

        foreach($sizes as $size){
            DB::table('product_sizes')->insert([
                'size' => $size,
            ]);
        }
    }
}
