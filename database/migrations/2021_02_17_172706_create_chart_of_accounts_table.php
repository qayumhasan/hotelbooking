<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('code_int')->nullable();
            $table->string('desription_of_account')->nullable();

            $table->integer('category_id')->nullable();
            $table->string('category_name',50)->nullable();
            $table->string('category_code')->nullable();

            $table->integer('maincategory_id')->nullable();
            $table->string('maincategory_name',50)->nullable();
            $table->string('maincategory_code')->nullable();

            $table->integer('subcategoryone_id')->nullable();
            $table->string('subcategoryone_name',50)->nullable();
            $table->string('subcategoryone_code')->nullable();

            $table->integer('subcategorytwo_id')->nullable();
            $table->string('subcategorytwo_name',50)->nullable();
            $table->string('subcategorytwo_code')->nullable();



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
        Schema::dropIfExists('chart_of_accounts');
    }
}
