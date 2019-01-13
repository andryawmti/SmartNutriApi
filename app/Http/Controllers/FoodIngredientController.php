<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\FoodIngredient;
use App\FoodIngredientCategory;
use App\FoodIngredientUrt;
use App\Urt;

class FoodIngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.food_ingredient.index', [
            'food_ingredients' => FoodIngredient::all(),
            'categories' => FoodIngredientCategory::all(),
            'urts' => Urt::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'food_ingredient_category_id' => 'required',
            'name' => 'required',
            'weight' => 'required'
        ]);

        try {
            $foodIngredient = new FoodIngredient();
            $foodIngredient->food_ingredient_category_id = request('food_ingredient_category_id');
            $foodIngredient->name = request('name');
            $foodIngredient->weight = request('weight');
            $foodIngredient->save();

            $foodIngredientUrt = json_decode(request('food_ingredient_urts'));

            $result = FoodIngredientUrt::addItems($foodIngredientUrt, $foodIngredient->id);
            if (!$result['success']) {
                return MyHttpResponse::updateResponse(false, $result['message'], 'food-ingredient.show', $foodIngredient->id);
            }

            return MyHttpResponse::storeResponse(true, 'Ingredient Successfully Created', 'food-ingredient.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'food-ingredient.index');
        }
    }

    public function show(FoodIngredient $foodIngredient)
    {
        $urts = [];

        foreach ($foodIngredient->foodIngredientUrt as $item) {
            $urts[] = [
                'id' => $item->id,
                'urt_id' => $item->urt_id,
                'urt_name' => $item->urt->name,
                'quantity' => $item->quantity,
            ];
        }

        return view('manage.food_ingredient.edit', [
            'food_ingredient' => $foodIngredient,
            'categories' => FoodIngredientCategory::all(),
            'urts' => Urt::all(),
            'food_ingredient_urts' => $urts,
        ]);
    }

    public function update(FoodIngredient $foodIngredient)
    {
        request()->validate([
            'food_ingredient_category_id' => 'required',
            'name' => 'required',
            'weight' => 'required'
        ]);

        try {

            $foodIngredientUrt = json_decode(request('food_ingredient_urts'));

            $result = FoodIngredientUrt::addItems($foodIngredientUrt, $foodIngredient->id);
            if (!$result['success']) {
                return MyHttpResponse::updateResponse(false, $result['message'], 'food-ingredient.show', $foodIngredient->id);
            }

            $foodIngredient->food_ingredient_category_id = request('food_ingredient_category_id');
            $foodIngredient->name = request('name');
            $foodIngredient->weight = request('weight');
            $foodIngredient->save();

            return MyHttpResponse::updateResponse(true, 'Ingredient Successfully Updated', 'food-ingredient.show', $foodIngredient->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'food-ingredient.show', $foodIngredient->id);
        }
    }

    public function destroy(FoodIngredient $foodIngredient)
    {
        try {
            $foodIngredient->foodIngredientUrt()->delete();
            $foodIngredient->delete();
            return MyHttpResponse::deleteResponse(true, 'Ingredient Successfully Deleted', 'food-ingredient.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'food-ingredient.index');
        }
    }
}
