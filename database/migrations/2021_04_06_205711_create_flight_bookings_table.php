<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('passenger_type')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('dob')->nullable();
            $table->integer('age')->nullable();
            $table->integer('passport_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('passport_issuing_authority')->nullable();
            $table->string('gender')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('room_number')->nullable();
            $table->string('product_type')->nullable();
            $table->text('booking_data')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('target_currency')->nullable();
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
        Schema::dropIfExists('flight_bookings');
    }
}
