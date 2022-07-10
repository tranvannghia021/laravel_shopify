<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductShopifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('product_shopifys')->insert([
            'id_shopify'=>'1212',
            'name_category'=>'tesst',
            'title'=>$faker->name,
            'body_html'=>$faker->text,
            'vendor'=>'nghia132',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
