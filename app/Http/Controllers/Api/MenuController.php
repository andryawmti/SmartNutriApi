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
            $total_calorie = 0;
            $total_carbohydrate = 0;
            $total_protein = 0;
            $total_fat = 0;
            foreach ($rawMenuItems as $item) {
                $category = $item->foodIngredient->foodIngredientCategory;

                $total_calorie += $category->calorie * $item->quantity;
                $total_carbohydrate += $category->carbohydrate * $item->quantity;
                $total_protein += $category->protein * $item->quantity;
                $total_fat += $category->fat * $item->quantity;
            }

            $return[] = [
                'id' => $menu->id,
                'added_by' => $menu->admin->first_name . $menu->admin->last_name,
                'name' => $menu->name,
                'description' => $menu->description,
                'calorie' => $total_calorie,
                'carbohydrate' => $total_carbohydrate,
                'protein' => $total_protein,
                'fat' => $total_fat,
                'photo' => $menu->photo,
                'created_at' => date('Y-m-d H:i:s', strtotime($menu->created_at)),
                'updated_at' => date('Y-m-d H:i:s', strtotime($menu->updated_at)),
            ];
        }

        return ApiResponse::success('Menu Successfully Fetched', ['menus' => $return]);
    }

    public function get(Menu $menu)
    {
        $rawMenuItems = $menu->menuItems;
        $menuItems = [];

        $total_calorie = 0;
        $total_carbohydrate = 0;
        $total_protein = 0;
        $total_fat = 0;

        foreach ($rawMenuItems as $item) {
            $category = $item->foodIngredient->foodIngredientCategory;

            $menuItems[] = [
                'food_ingredient_id' => $item->food_ingredient_id,
                'food_ingredient_name' => $item->foodIngredient->name,
                'food_ingredient_weight' => $item->foodIngredient->weight * $item->quantity,
                'food_ingredient_category_name' => $category->name,
                'nutrition' => [
                    'calorie' => $category->calorie * $item->quantity,
                    'carbohydrate' => $category->carbohydrate * $item->quantity,
                    'protein' => $category->protein * $item->quantity,
                    'fat' => $category->fat * $item->quantity,
                ]
            ];

            $total_calorie += $category->calorie * $item->quantity;
            $total_carbohydrate += $category->carbohydrate * $item->quantity;
            $total_protein += $category->protein * $item->quantity;
            $total_fat += $category->fat * $item->quantity;
        }

        $return = [
            'id' => $menu->id,
            'added_by' => $menu->admin->first_name . $menu->admin->last_name,
            'name' => $menu->name,
            'description' => $menu->description,
            'photo' => $menu->photo,
            'created_at' => date('Y-m-d H:i:s', strtotime($menu->created_at)),
            'menu_items' => $menuItems,
            'total_nutrition' => [
                'calorie' => $total_calorie,
                'carbohydrate' => $total_carbohydrate,
                'protein' => $total_protein,
                'fat' => $total_fat,
            ]
        ];

        return ApiResponse::data($return);
    }
}
