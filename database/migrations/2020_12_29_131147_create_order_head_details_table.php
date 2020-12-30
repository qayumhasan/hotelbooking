<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHeadDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_head_details', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('unit')->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('order_head_details');
    }
}
