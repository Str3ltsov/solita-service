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
            OrderStatusesSeeder::class,
            CartStatusesSeeder::class,
            CategorySeeder::class,
            CookieSeeder::class,
            UserSeeder::class,
            DiscountSeeder::class,
            DiscountCouponSeeder::class,
            PromotionSeeder::class,
            ProductSeeder::class,
            ProductCategorySeeder::class,
            ReturnStatusesSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
