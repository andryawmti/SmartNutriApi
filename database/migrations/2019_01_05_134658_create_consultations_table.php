<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('weight', 10);
            $table->string('bed_time', 10)->comment('in hour');
            $table->string('activity', 10)->comment('in percentage');
            $table->string('pregnancy_age', 10)->comment('in week');
            $table->string('calorie_need', 10)->comment('calorie in KKal');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}
