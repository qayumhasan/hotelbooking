<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_heads', function (Blueprint $table) {
            $table->id();
            $table->string('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('rate')->nullable();
            $table->float('amount')->nullable();
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
        Schema::dropIfExists('purchase_heads');
    }
}
