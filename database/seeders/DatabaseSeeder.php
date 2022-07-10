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
        // \App\Models\User::factory(10)->create();
        // for ($i = 0; $i <= 10; $i++) {
        //     $this->call([
        //         CategorysSeeder::class,
        //         ProductsSeeder::class,
        //         ProductShopifySeeder::class,
        //        ProductShopifyDetailSeeder::class,
        //        ImagesSeeder::class,
        //     ]);
        // }
        $this->call([
           // CategoryShopifySeeder::class,
            AccountsSeeder::class,
        ]);
    }
}
