<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalStockHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_stock_heads', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_center')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('num_of_qty')->nullable();
            $table->integer('num_of_item')->nullable();
            $table->text('narration')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_deleted')->default(0);

            $table->string('date',30)->nullable();
            $table->string('entry_by',30)->nullable();
            $table->string('entry_date',30)->nullable();
            $table->string('updated_by',30)->nullable();
            $table->string('updated_date',30)->nullable();
            $table->integer('is_approve')->default(0);
            $table->string('approve_by',30)->nullable();
            $table->string('approve_date',30)->nullable();
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
        Schema::dropIfExists('physical_stock_heads');
    }
}
