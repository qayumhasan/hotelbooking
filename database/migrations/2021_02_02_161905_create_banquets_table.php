<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanquetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banquets', function (Blueprint $table) {
            $table->id();
            $table->string('title',10)->nullable();
            $table->string('guest_name')->nullable();
            $table->string('print_name')->nullable();
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();

            $table->integer('booking_no')->nullable();
            $table->integer('venue_id')->nullable();
            $table->string('booking_for')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('date_of_function_form')->nullable();
            $table->string('date_of_function_to')->nullable();
            $table->string('type_of_function')->nullable();
            $table->text('remarks')->nullable();

            $table->integer('menutype')->nullable();
            $table->integer('guest_type')->nullable();
            $table->float('price_per_pax')->nullable();
            $table->float('guarantee_pax')->nullable();
            $table->text('welcome_board')->nullable();
            $table->string('no_of_rooms')->nullable();

            $table->text('banquet_file')->nullable();

            $table->float('total_pax_amount')->nullable();
            $table->float('total_other_item_amount')->nullable();
            $table->float('total_net_amount')->nullable();

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
        Schema::dropIfExists('banquets');
    }
}
