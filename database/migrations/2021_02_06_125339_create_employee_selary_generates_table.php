<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSelaryGeneratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_selary_generates', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('employee_user_id',30)->nullable();
            $table->string('name',30)->nullable();
            $table->string('designation',30)->nullable();
            $table->float('salary')->nullable();
            $table->float('gross_salary')->nullable();
            $table->string('mode_of_payment',30)->nullable();
            $table->integer('number_of_working_days')->nullable();
            $table->integer('guaranteed_leave')->nullable();
            $table->integer('leave')->nullable();
            $table->integer('overtime')->nullable();
            $table->string('generate_date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            
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
        Schema::dropIfExists('employee_selary_generates');
    }
}
