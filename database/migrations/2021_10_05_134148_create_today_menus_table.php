<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodayMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('today_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->index();
            $table->bigInteger('hotel_id')->index();
            $table->bigInteger('food_category_id')->index();
            $table->bigInteger('food_type_id')->index();
            $table->bigInteger('item_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('today_menus');
    }
}
