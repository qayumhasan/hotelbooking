<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_models', function (Blueprint $table) {
            $table->id();
            $table->string('sms_url')->nullable();
            $table->string('sms_username')->nullable();
            $table->string('sms_password')->nullable();
            $table->integer('sms_type')->nullable();
            $table->string('sms_masking')->nullable();
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
        Schema::dropIfExists('sms_models');
    }
}
