<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\Consultation;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuSuggestion;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get(Consultation $consultation)
    {
        $rawMenuSuggestion = $consultation->menuSuggestion;
        $suggestion = [];

        foreach ($rawMenuSuggestion as $m) {
            $rawMenuItems = $m->menu->menuItems;
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

            $suggestion[] = [
                'id' => $m->menu->id,
                'added_by' => $m->menu->admin->first_name . $m->menu->admin->last_name,
                'name' => $m->menu->name,
                'description' => $m->menu->description,
                'photo' => $m->menu->photo,
                'created_at' => date('Y-m-d', strtotime($m->menu->created_at)),
                'menu_items' => $menuItems,
                'calorie' => $total_calorie,
                'carbohydrate' => $total_carbohydrate,
                'protein' => $total_protein,
                'fat' => $total_fat,
            ];
        }

        $return = [
            "user_id" => $consultation->user_id,
            "weight" => $consultation->weight,
            "bed_time" => $consultation->bed_time,
            "activity" => $consultation->activity,
            "pregnancy_age" => $consultation->pregnancy_age,
            "calorie_need" => $consultation->calorie_need,
            "created_at" => date('Y-m-d', strtotime($consultation->created_at)),
            "updated_at" => date('Y-m-d', strtotime($consultation->updated_at)),
            'menu_list' => $suggestion
        ];

        return ApiResponse::data($return);
    }

    public function findAllByUserId($userId)
    {
        return ApiResponse::data(Consultation::findAllByUserId($userId)->toArray());
    }

    public function store()
    {
        try {
            $consultation = new Consultation();
            $consultation->user_id = request('user_id');
            $consultation->weight = request('weight');
            $consultation->bed_time = request('bed_time');
            $consultation->activity = request('activity');
            $consultation->pregnancy_age = request('pregnancy_age');
            $consultation->calorie_need = request('calorie_need');
            $consultation->save();

            $menuSuggestion = Menu::getMenuSuggestionByCalorieNeed(request('calorie_need'));

            foreach ($menuSuggestion as $m) {
                MenuSuggestion::create([
                    'consultation_id' => 3,
                    'menu_id' => $m->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            return ApiResponse::success('Consultation Saved', ['menu_suggestion' => $menuSuggestion]);
        } catch (\Exception $e) {
            return ApiResponse::error('User Update Failed, caused by: ' . $e->getMessage());
        }
    }
}
