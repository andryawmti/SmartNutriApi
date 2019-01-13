<?php

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
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UrtSeeder::class);
        $this->call(FoodIngredientCategorySeeder::class);
        $this->call(FoodIngredientSeeder::class);
        $this->call(FoodIngredientUrtSeeder::class);
    }
}
