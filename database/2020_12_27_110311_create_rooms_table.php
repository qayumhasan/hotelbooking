<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('date',40)->nullable();
            $table->string('room_no',40)->nullable();
            $table->integer('room_status')->default(1);
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('room_type')->nullable();
            $table->foreignId('floor')->nullable();
            $table->string('toilet',40)->nullable();
            $table->string('tariff',40)->nullable();
            $table->string('category',40)->nullable();
            $table->text('room_details')->nullable();
            $table->text('image')->nullable();
            $table->integer('is_active')->default(1);
            $table->string('is_occupy')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
