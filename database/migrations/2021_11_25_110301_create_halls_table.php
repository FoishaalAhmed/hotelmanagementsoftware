<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('hall_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('capacity');
            $table->boolean('board')->default(true);
            $table->boolean('stage')->default(true);
            $table->boolean('projector')->default(true);
            $table->boolean('ac')->default(true);
            $table->boolean('fan')->default(true);
            $table->boolean('sound_system')->default(true);
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
        Schema::dropIfExists('halls');
    }
}
