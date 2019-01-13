<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\FoodIngredientCategory;

class FoodIngredientCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.food_ingredient_category.index', ['categories' => FoodIngredientCategory::all()]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);

        try {
            $foodIngredientCategory = new FoodIngredientCategory();
            $foodIngredientCategory->name = request('name');
            $foodIngredientCategory->calorie = request('calorie') ? request('calorie') : 0;
            $foodIngredientCategory->protein = request('protein') ? request('protein') : 0;
            $foodIngredientCategory->carbohydrate = request('carbohydrate') ? request('carbohydrate') : 0;
            $foodIngredientCategory->fat = request('fat') ? request('fat') : 0;
            $foodIngredientCategory->save();

            return MyHttpResponse::storeResponse(true, 'Category Successfully Created', 'food-ingredient-category.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'food-ingredient-category.index');
        }
    }

    public function show(FoodIngredientCategory $foodIngredientCategory)
    {
        return view('manage.food_ingredient_category.edit', ['category' => $foodIngredientCategory]);
    }

    public function update(FoodIngredientCategory $foodIngredientCategory)
    {
        request()->validate([
            'name' => 'required',
        ]);

        try {
            $foodIngredientCategory->name = request('name');
            $foodIngredientCategory->calorie = request('calorie') ? request('calorie') : 0;
            $foodIngredientCategory->protein = request('protein') ? request('protein') : 0;
            $foodIngredientCategory->carbohydrate = request('carbohydrate') ? request('carbohydrate') : 0;
            $foodIngredientCategory->fat = request('fat') ? request('fat') : 0;
            $foodIngredientCategory->save();

            return MyHttpResponse::updateResponse(true, 'Category Successfully Created', 'food-ingredient-category.show', $foodIngredientCategory->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'food-ingredient-category.index', $foodIngredientCategory->id);
        }
    }

    public function destroy(FoodIngredientCategory $foodIngredientCategory)
    {
        try {
            $foodIngredientCategory->delete();
            return MyHttpResponse::deleteResponse(true, 'Category Successfully Deleted', 'food-ingredient-category.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'food-ingredient-category.index');
        }
    }
}
