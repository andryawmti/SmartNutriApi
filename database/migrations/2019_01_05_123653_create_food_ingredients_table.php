<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('food_ingredient_category_id');
            $table->string('name', 50);
            $table->unsignedInteger('weight')->comment('in gram');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('food_ingredient_category_id')
                ->references('id')
                ->on('food_ingredient_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_ingredients');
    }
}
