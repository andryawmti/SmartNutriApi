<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('food_ingredient_id');
            $table->unsignedInteger('quantity');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('menu_id')
                ->references('id')
                ->on('menus');

            $table->foreign('food_ingredient_id')
                ->references('id')
                ->on('food_ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
