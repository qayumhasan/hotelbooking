<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckBookTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_book_transections', function (Blueprint $table) {
            $table->id();

            $table->string('account_code',30)->nullable();
            $table->integer('book_id')->nullable();
            $table->string('check_number',30)->nullable();
            $table->string('voucher_number',30)->nullable();
            $table->string('check_date',30)->nullable();
            $table->float('check_amount',30)->nullable();
            $table->float('delevery_date',30)->nullable();
            $table->string('status')->nullable();
  

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
        Schema::dropIfExists('check_book_transections');
    }
}
