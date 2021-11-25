<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->index();
            $table->time('time')->index();
            $table->string('invoice', 20)->index();
            $table->bigInteger('hotel_id')->index();
            $table->bigInteger('room_id')->index();
            $table->bigInteger('table_id')->index()->nullable();
            $table->bigInteger('user_id')->index();
            $table->float('subtotal', 11, 2);
            $table->float('vat', 11, 2);
            $table->float('discount', 11, 2)->nullable();
            $table->float('total', 11, 2);
            $table->float('paid', 11, 2)->nullable();
            $table->float('method', 11, 2);
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
        Schema::dropIfExists('orders');
    }
}
