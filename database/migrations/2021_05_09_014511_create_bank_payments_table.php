<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->index();
            $table->bigInteger('booking_id')->index()->unsigned();
            $table->string('invoice', 15)->index();
            $table->date('date')->index();
            $table->string('method');
            $table->string('bank')->nullable();
            $table->string('card_number')->nullable();
            $table->string('cheque_number')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('acc_number')->nullable();
            $table->string('deposited_acc_number')->nullable();
            $table->float('amount', 11, 2);
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
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
        Schema::dropIfExists('bank_payments');
    }
}
