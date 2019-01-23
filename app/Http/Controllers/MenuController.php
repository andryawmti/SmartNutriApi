<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\FoodIngredient;
use App\Menu;
use App\MenuItem;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.menu.index', ['menus' => Menu::all(), 'food_ingredients' => FoodIngredient::all()]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'menu_items' => 'required'
        ]);

        try {
            $menu = new Menu();
            $menu->name = request('name');
            $menu->description = request('description');
            $menu->admin_id = auth()->user()->id;
            $menu->save();

            $menu_items = json_decode(request('menu_items'));

            $result = MenuItem::addItems($menu_items, $menu->id);
            if (!$result['success']) {
                return MyHttpResponse::storeResponse(false, $result['message'], 'menu.index');
            }

            return MyHttpResponse::storeResponse(true, 'Menu Successfully Created', 'menu.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'menu.index');
        }
    }

    public function show(Menu $menu)
    {
        $menu_items = [];
        foreach ($menu->menuItems as $item) {
            $menu_items [] = [
                'food_ingredient_id' => $item->food_ingredient_id,
                'food_ingredient_name' => $item->foodIngredient->name,
                'quantity' => $item->quantity,
            ];
        }

        return view('manage.menu.edit', ['menu' => $menu, 'menu_items' => $menu_items, 'food_ingredients' => FoodIngredient::all()]);
    }

    public function update(Menu $menu)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'menu_items' => 'required'
        ]);

        try {
            $menu->name = request('name');
            $menu->description = request('description');
            $menu->save();

            $menu_items = json_decode(request('menu_items'));

            $result = MenuItem::addItems($menu_items, $menu->id);
            if (!$result['success']) {
                return MyHttpResponse::updateResponse(false, $result['message'], 'menu.show', $menu->id);
            }

            return MyHttpResponse::updateResponse(true, 'Menu Successfully Created', 'menu.show', $menu->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'menu.show', $menu->id);
        }
    }

    public function destroy(Menu $menu)
    {
        try {
            $menu->menuItems()->delete();
            $menu->delete();
            return MyHttpResponse::deleteResponse(true, 'Menu Successfully Deleted', 'menu.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'menu.index');
        }
    }
}
