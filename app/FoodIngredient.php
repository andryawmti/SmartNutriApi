<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodIngredient extends Model
{
    public function foodIngredientCategory()
    {
        return $this->belongsTo('App\FoodIngredientCategory');
    }

    public function foodIngredientUrt()
    {
        return $this->hasMany('App\FoodIngredientUrt');
    }
}
