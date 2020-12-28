<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('employee_name');
            $table->string('date')->nullable();
            $table->integer('district');
            $table->integer('police_station');
            $table->string('employee_type');

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('maritial_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_number');
            $table->string('family_mobile_number')->nullable();
            $table->string('email');
            $table->string('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('national_id')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('image');
            $table->string('cv')->nullable();
            $table->string('joining_letter')->nullable();

            $table->string('present_designation');
            $table->string('working_hour');
            $table->string('present_salary');
            $table->string('previous_company')->nullable();
            $table->string('previous_company_address')->nullable();
            $table->string('previous_designation')->nullable();
            $table->string('previous_salary')->nullable();
            $table->string('previous_join_date')->nullable();
            $table->string('previous_end_date')->nullable();
            $table->string('opening_balance')->default(0);
            $table->string('balance')->default(0);
            $table->string('brance_id')->nullable();
            $table->integer('status')->default(1);

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
        Schema::dropIfExists('employees');
    }
}
