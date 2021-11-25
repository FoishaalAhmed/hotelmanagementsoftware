<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->index();
            $table->bigInteger('booking_id');
            $table->bigInteger('room_id');
            $table->integer('person');
            $table->string('name');
            $table->date('check_in');
            $table->date('check_out')->nullable();
            $table->tinyInteger('status')->comment('0 = not confirmed, 1 = confirmed, 2 = cancel, 3 = checked out');
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
        Schema::dropIfExists('booking_details');
    }
}
