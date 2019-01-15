<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAll()
    {
        $menus = Menu::all();
        $return = [];

        foreach ($menus as $menu) {
            $rawMenuItems = $menu->menuItems;
            $menuItems = [];

            foreach ($rawMenuItems as $item) {
                $category = $item->foodIngredient->foodIngredientCategory;

                $menuItems[] = [
                    'food_ingredient_id' => $item->food_ingredient_id,
                    'food_ingredient_name' => $item->foodIngredient->name,
                    'food_ingredient_weight' => $item->foodIngredient->weight,
                    'food_ingredient_category_name' => $category->name,
                    'nutrition' => [
                        'calorie' => $category->calorie,
                        'carbohydrate' => $category->carbohydrate,
                        'protein' => $category->protein,
                        'fat' => $category->fat,
                    ]
                ];
            }

            $return[] = [
                'id' => $menu->id,
                'added_by' => $menu->admin->first_name . $menu->admin->last_name,
                'name' => $menu->name,
                'created_at' => date('Y-m-d H:i:s', strtotime($menu->created_at)),
                'menu_items' => $menuItems,

            ];
        }

        return ApiResponse::data($return);
    }

    public function get(Menu $menu)
    {
        $rawMenuItems = $menu->menuItems;
        $menuItems = [];

        foreach ($rawMenuItems as $item) {
            $category = $item->foodIngredient->foodIngredientCategory;

            $menuItems[] = [
                'food_ingredient_id' => $item->food_ingredient_id,
                'food_ingredient_name' => $item->foodIngredient->name,
                'food_ingredient_weight' => $item->foodIngredient->weight,
                'food_ingredient_category_name' => $category->name,
                'nutrition' => [
                    'calorie' => $category->calorie,
                    'carbohydrate' => $category->carbohydrate,
                    'protein' => $category->protein,
                    'fat' => $category->fat,
                ]
            ];
        }

        $return = [
            'id' => $menu->id,
            'added_by' => $menu->admin->first_name . $menu->admin->last_name,
            'name' => $menu->name,
            'created_at' => date('Y-m-d H:i:s', strtotime($menu->created_at)),
            'menu_items' => $menuItems,

        ];

        return ApiResponse::data($return);
    }
}
