<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantOrderHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant__order_heads', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_no',50)->nullable();
            $table->integer('number_of_item')->nullable();
            $table->integer('number_of_qty')->nullable();
            $table->float('total_amount')->nullable();
            $table->integer('no_of_pax')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('mobile_no')->nullable();
            $table->integer('payment_method')->nullable();
            $table->text('payment_details')->nullable();
            $table->integer('table_no')->nullable();
            $table->string('room_no')->nullable();
            $table->string('booking_no')->nullable();
            $table->text('remarks')->nullable();
            $table->float('gross_amount')->default(0);

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
        Schema::dropIfExists('restaurant__order_heads');
    }
}
