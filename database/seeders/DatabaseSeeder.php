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
//            CartStatusesSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            CookieSeeder::class,
            UserStatusSeeder::class,
            UserSeeder::class,
//            DiscountSeeder::class,
//            DiscountCouponSeeder::class,
//            PromotionSeeder::class,
            ProductSeeder::class,
            ProductCategorySeeder::class,
            ReturnStatusesSeeder::class,
//            CartSeeder::class,
            OrderPrioritySeeder::class,
            OrderSeeder::class,
            OrderUserSeeder::class,
            OrderUserActivitySeeder::class,
            UserReviewSeeder::class,
            SkillSeeder::class,
            SkillUserSeeder::class,
            SpecialistOccupationSeeder::class,
            ExperienceSeeder::class,
            OrderQuestionSeeder::class
        ]);
    }
}
