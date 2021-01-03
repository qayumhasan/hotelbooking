<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no',50)->nullable();
            $table->string('order_no',50)->nullable();
            $table->string('ref_invoice_no',50)->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->string('supplier_name',50)->nullable();
            $table->foreignId('stock_center')->nullable();
            $table->text('narration')->nullable();
            $table->string('tota_amount',50)->nullable();
            $table->string('gross_amount',50)->nullable();
            $table->string('tax_amount',50)->nullable();
            $table->string('net_amount',50)->nullable();
            $table->string('payment',50)->nullable();
            $table->string('due',50)->nullable();

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
        Schema::dropIfExists('purchases');
    }
}
