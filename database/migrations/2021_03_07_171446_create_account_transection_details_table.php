<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transection_details', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_no')->nullable();
            $table->string('date')->nullable();
            $table->string('account_head_details')->nullable();
            $table->string('category_code')->nullable();
            $table->string('Accountcategory_code')->nullable();
            $table->string('subcategory_codeone')->nullable();
            $table->string('subcategory_codetwo')->nullable();
            $table->integer('qty')->nullable();
            $table->float('price')->nullable();
            $table->float('dr_amount')->nullable();
            $table->float('cr_amount')->nullable();

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
        Schema::dropIfExists('account_transection_details');
    }
}
