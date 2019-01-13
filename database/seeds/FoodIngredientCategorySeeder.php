<?php

use Illuminate\Database\Seeder;

class FoodIngredientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sumber Karbohidrat',
                'calorie' => 175,
                'protein' => 4,
                'carbohydrate' => 40,
                'fat' => NULL,
            ],
            [
                'name' => 'Sumber Protein Hewani',
                'calorie' => 95,
                'protein' => 10,
                'carbohydrate' => NULL,
                'fat' => 6,
            ],
            [
                'name' => 'Sumber Protein Nabati',
                'calorie' => 80,
                'protein' => 6,
                'carbohydrate' => 8,
                'fat' => 3,
            ],
            [
                'name' => 'Sayuran Golongan A',
                'calorie' => 40,
                'protein' => NULL,
                'carbohydrate' => 10,
                'fat' => NULL,
            ],
            [
                'name' => 'Sayuran Golongan B',
                'calorie' => 50,
                'protein' => 3,
                'carbohydrate' => 10,
                'fat' => NULL,
            ],
            [
                'name' => 'Buah',
                'calorie' => 40,
                'protein' => NULL,
                'carbohydrate' => 10,
                'fat' => NULL,
            ],
            [
                'name' => 'Susu',
                'calorie' => 110,
                'protein' => 7,
                'carbohydrate' => 7,
                'fat' => 7,
            ],
            [
                'name' => 'Minyak',
                'calorie' => 45,
                'protein' => NULL,
                'carbohydrate' => NULL,
                'fat' => 5,
            ],
        ];

        foreach ($categories as $category) {
            \App\FoodIngredientCategory::create($category);
        }
    }
}
