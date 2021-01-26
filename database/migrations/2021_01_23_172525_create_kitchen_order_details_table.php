<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitchenOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('room_no',40)->nullable();
            $table->integer('booking_no')->nullable();
            $table->string('guest_name',70)->nullable();
            $table->string('kot_date',70)->nullable();
            $table->string('kot_timehour',70)->nullable();
            $table->string('kot_timemin',70)->nullable();
            $table->string('waiter_name',70)->nullable();
            $table->integer('waiter_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->text('item_name')->nullable();
            $table->integer('qty')->nullable();
            $table->float('rate')->nullable();
            $table->float('amount')->nullable();
            $table->integer('complementary')->default(0);
            $table->string('invoice_id')->nullable();
            $table->integer('kot_status')->default(0);
            
            $table->integer('billing_status')->default(0);


            
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
        Schema::dropIfExists('kitchen_order_details');
    }
}
