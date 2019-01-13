<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'food_ingredient_id',
        'quantity'
    ];

    public function foodIngredient()
    {
        return $this->belongsTo('App\FoodIngredient');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public static function removeItemsByMenuId($menuId)
    {
        return MenuItem::where('menu_id', $menuId)->delete();
    }

    public static function addItems(array $items, $menuId)
    {
        self::removeItemsByMenuId($menuId);

        $total_task = count($items);
        $total_success = 0;
        $error_message = '';

        foreach ($items as $item) {
            try {
                MenuItem::create([
                    'menu_id' => $menuId,
                    'food_ingredient_id' => $item->food_ingredient_id,
                    'quantity' => $item->quantity,
                ]);
                $total_success += 1;
            } catch (\Exception $e) {
                $error_message = $e->getMessage() . '. ';
            }
        }

        if ($total_success != $total_task) {
            return [
                'success' => false,
                'message' => $error_message,
            ];
        } else {
            return [
                'success' => true,
                'message' => 'Items successfully added',
            ];
        }
    }
}
