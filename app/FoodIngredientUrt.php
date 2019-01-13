<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodIngredientUrt extends Model
{
    protected $fillable = [
        'food_ingredient_id',
        'quantity',
        'urt_id',
    ];

    public function foodIngredient()
    {
        return $this->belongsTo('App\FoodIngredient');
    }

    public function urt()
    {
        return $this->belongsTo('App\Urt');
    }

    public static function removeItemsByFoodIngredientId($id)
    {
        return FoodIngredientUrt::where('food_ingredient_id', $id)->delete();
    }

    public static function addItems(array $items, $foodIngredientId)
    {
        self::removeItemsByFoodIngredientId($foodIngredientId);
        $total_task = count($items);
        $total_done = 0;
        $error_message = '';
        foreach ($items as $item) {
            try {
                FoodIngredientUrt::create([
                    'food_ingredient_id' => $foodIngredientId,
                    'urt_id' => $item->urt_id,
                    'quantity' => $item->quantity
                ]);
                $total_done += 1;
            } catch (\Exception $e) {
                $error_message .= $e->getMessage() . '. ';
            }
        }
        if ($total_task !=  $total_done) {
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
