<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('table_no');
            $table->string('booking_no');
            $table->string('kot_date');
            $table->string('kot_time');
            $table->string('waiter_id');
            $table->string('item_id');
            $table->string('qty');
            $table->string('rate');
            $table->string('amount');
            $table->string('complement');
            $table->string('invoice_id');
            $table->string('kot_status')->default(0);
            $table->string('kot_remarks')->nullable();
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('restaurant_order_details');
    }
}
