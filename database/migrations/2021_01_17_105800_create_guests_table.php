<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->string('title');
            $table->string('print_name');
            $table->string('gender');
            $table->string('company_name')->nullable();
            $table->string('city');
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('id_no')->nullable();
            $table->string('file_no')->nullable();
            $table->string('mobile');
            $table->string('client_img')->nullable();
            $table->string('email')->nullable();

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
        Schema::dropIfExists('guests');
    }
}
