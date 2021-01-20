<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvanceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->integer('booked_by');
            $table->string('booking_date');
            $table->string('checkindate');
            $table->string('checkintime');
            $table->string('checkoutdate');
            $table->string('checkouttime');
            $table->string('year');
            $table->integer('guest_id');
            $table->string('room_type');
            $table->string('no_of_rooms');
            $table->integer('room_id');
            $table->integer('tariff');
            $table->string('thru_agent')->nullable();
            $table->string('booking_source')->nullable();
            $table->text('remarks')->nullable();
            

            
            $table->string('date',40)->nullable();
            $table->integer('is_active')->default(1);
            $table->string('entry_by',30)->nullable();
            $table->string('entry_date',30)->nullable();
            $table->string('updated_by',30)->nullable();
            $table->string('updated_date',30)->nullable();
            $table->integer('is_approve')->default(0);
            $table->string('approve_by',30)->nullable();
            $table->string('approve_date',30)->nullable();
            $table->integer('is_deleted')->default(0);
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
        Schema::dropIfExists('advance_bookings');
    }
}
