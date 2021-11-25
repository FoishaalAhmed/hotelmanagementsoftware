<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->index();
            $table->bigInteger('invoice');
            $table->string('name');
            $table->string('phone')->index();
            $table->string('email')->index();
            $table->string('address');
            $table->integer('room');
            $table->integer('adult');
            $table->integer('children')->nullable();
            $table->float('rent');
            $table->float('vat')->nullable();
            $table->float('vat_amount')->nullable();
            $table->float('subtotal');
            $table->float('discount')->nullable();
            $table->float('total');
            $table->string('nid_number')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
