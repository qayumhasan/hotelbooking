<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanquetTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banquet_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_no')->nullable();
            $table->integer('tax_id')->nullable();
            $table->string('tax_description')->nullable();
            $table->string('calculation_on')->nullable();
            $table->string('based_on')->nullable();
            $table->float('tax_rate')->nullable();
            $table->float('tax_amount')->nullable();
            $table->string('tax_effect')->nullable();



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
        Schema::dropIfExists('banquet_taxes');
    }
}
