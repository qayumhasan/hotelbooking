<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitchenOrderHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_order_heads', function (Blueprint $table) {
            $table->id();
            $table->integer('room_no')->nullable();
            $table->integer('booking_no')->nullable();
            $table->string('guest_name')->nullable();
            $table->integer('num_of_item')->nullable();
            $table->integer('num_of_qty')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('date')->nullable();
            $table->float('total_amount')->nullable();


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
        Schema::dropIfExists('kitchen_order_heads');
    }
}
