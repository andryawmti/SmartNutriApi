<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function menuItems()
    {
        return $this->hasMany('App\MenuItem');
    }

    public static function getMenuSuggestionByCalorieNeed($calorie)
    {
        $menuSuggestion = [];

        $caloriePerMenu = (double)$calorie / 3;
        $caloriePerMenu = ceil($caloriePerMenu);

        $sql = "SELECT *, ABS($caloriePerMenu - calorie) AS delta_calorie FROM menu_helper WHERE ABS($caloriePerMenu - calorie) <= 20";
        $orderBy = " ORDER BY delta_calorie ASC";

        $firstMenu = DB::select($sql . $orderBy);
        $lengthOne = count($firstMenu);

        if ($lengthOne) {
            $firstMenu = $firstMenu[(int)rand(0, $lengthOne - 1)];
            $menuSuggestion[] = $firstMenu;
        }

        $secondMenu = false;
        if ($firstMenu) {
            $secondMenu = DB::select($sql . 'WHERE id != ' . $firstMenu['id'] . $orderBy);
            $lengthTwo = count($secondMenu);
            if ($lengthTwo) {
                $secondMenu = $secondMenu[(int)(rand(0, $lengthTwo - 1))];
                $menuSuggestion[] = $secondMenu;
            }
        }

        if ($secondMenu) {
            $thirdMenu = DB::select($sql . 'WHERE id != ' . $secondMenu['id']);
            $lengthThree = count($thirdMenu);
            if ($lengthThree) {
                $thirdMenu = $thirdMenu[(int)(rand(0, $lengthThree - 1))];
                $menuSuggestion[] = $thirdMenu;
            }
        }

        return $menuSuggestion;
    }
}
