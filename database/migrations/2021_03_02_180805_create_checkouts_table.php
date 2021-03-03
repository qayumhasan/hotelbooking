<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('prime_room');
            $table->string('booking_no');
            $table->string('invoice_no');
            $table->string('invoice_date')->nullable();
            $table->string('checkout_date');
            $table->string('checkout_time');
            $table->string('grace_time')->nullable();
            $table->float('room_amount')->nullable();
            $table->float('extra_service_amount')->nullable();
            $table->float('fb_amount')->nullable();
            $table->float('restaurant_amount')->nullable();
            $table->float('voucher_amount')->nullable();
            $table->float('net_amount')->nullable();
            $table->float('gross_amount')->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('outstanding_amount')->nullable();
            $table->float('advance_amount')->nullable();
            $table->text('additional_room')->nullable();

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
        Schema::dropIfExists('checkouts');
    }
}
