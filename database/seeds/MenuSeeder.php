<?php

use App\Menu;
use App\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Menu One',
                'admin_id' => 1,
                'menu_items' => [
                    [
                        'food_ingredient_id' => 1,
                        'quantity' => 2,
                    ],
                    [
                        'food_ingredient_id' => 23,
                        'quantity' => 2,
                    ],
                    [
                        'food_ingredient_id' => 30,
                        'quantity' => 1,
                    ]
                ]
            ]
        ];

        foreach ($menus as $m) {
            $menu = Menu::create([
                'name' => $m['name'],
                'admin_id' => $m['admin_id'],
                'description' => 'This is a description',
            ]);

            foreach ($m['menu_items'] as $item) {
                MenuItem::create([
                    'menu_id' => $menu->id,
                    'food_ingredient_id' => $item['food_ingredient_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }
    }
}
