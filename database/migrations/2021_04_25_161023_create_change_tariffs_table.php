<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no');
            $table->string('apply_date');
            $table->string('apply_time');
            $table->float('tarrif');
            $table->text('tariff_remarks')->nullable();
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
        Schema::dropIfExists('change_tariffs');
    }
}
