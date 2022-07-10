<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('products')->insert([
            'title'=>$faker->name,
            'price'=>$faker->numberBetween(10000,100000),
            'category_id'=>$faker->numberBetween(1,5),
            'quantity'=>$faker->numberBetween(5,20),
            'description'=>$faker->text(100),
            'status'=>'pending',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
