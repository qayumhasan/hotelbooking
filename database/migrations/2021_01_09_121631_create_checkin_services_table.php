<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_services', function (Blueprint $table) {
            $table->id();
            $table->integer('checkin_id');
            $table->string('service_no');
            $table->string('service_date');
            $table->string('service_time');
            $table->string('item_name');
            $table->string('amount')->nullable();
            $table->integer('service_category');
            $table->integer('services');
            $table->string('remarks');
            $table->string('rate');
            $table->integer('qty');
            $table->integer('is_third')->nullable();
            $table->integer('third_party')->nullable();

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
        Schema::dropIfExists('checkin_services');
    }
}
