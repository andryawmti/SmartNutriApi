<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodIngredientUrtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_ingredient_urts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('food_ingredient_id');
            $table->unsignedInteger('urt_id');
            $table->string('quantity', 5)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('food_ingredient_id')
                ->references('id')
                ->on('food_ingredients');

            $table->foreign('urt_id')
                ->references('id')
                ->on('urts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_ingredient_urts');
    }
}
