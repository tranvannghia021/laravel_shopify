<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductShopifyDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('product_shopify_details')->insert([
            'id_products_shopify'=>$faker->numberBetween(1,9),
            'id_image_shopify'=>$faker->numberBetween(1,3),
            'title'=>$faker->name,
            'price'=>$faker->numberBetween(100,2000),
            'quantity'=>10,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
