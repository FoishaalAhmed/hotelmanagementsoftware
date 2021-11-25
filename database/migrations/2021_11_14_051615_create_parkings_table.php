<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('charge_id')->constrained()->onDelete('cascade');
            $table->string('ticket', 100);
            $table->string('vehicle');
            $table->string('registration_number');
            $table->time('in_time');
            $table->time('out_time')->nullable();
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
            $table->mediumText('remark')->nullable();
            $table->string('method')->nullable();
            $table->integer('paid')->nullable();
            $table->tinyInteger('status')->comment('1= in, 2= out');
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
        Schema::dropIfExists('parkings');
    }
}
