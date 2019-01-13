<?php

use Illuminate\Database\Seeder;

class FoodIngredientUrtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredient_urts = [
            [
                'food_ingredient_id' => 1,
                'urt_id' => 6,
                'quantity' => '3/4',
            ],
            [
                'food_ingredient_id' => 2,
                'urt_id' => 6,
                'quantity' => '1.5',
            ],
            [
                'food_ingredient_id' => 3,
                'urt_id' => 6,
                'quantity' => '1',
            ],
            [
                'food_ingredient_id' => 4,
                'urt_id' => 6,
                'quantity' => '1/4',
            ],
            [
                'food_ingredient_id' => 5,
                'urt_id' => 2,
                'quantity' => '4',
            ],
            [
                'food_ingredient_id' => 5,
                'urt_id' => 5,
                'quantity' => NULL,
            ]
        ];

        foreach ($ingredient_urts as $urt) {
            \App\FoodIngredientUrt::create($urt);
        }
    }
}
