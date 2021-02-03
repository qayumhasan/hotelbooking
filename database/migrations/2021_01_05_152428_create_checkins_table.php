<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->string('checking_by');
            $table->string('date');
            $table->integer('booking_no');
            $table->integer('room_type');
            $table->integer('room_no');
            $table->string('booking_type');
            $table->string('checkout_time');
            $table->integer('advance_booking')->nullable();
            $table->string('adv_guest_name')->nullable();
            $table->string('adv_booking_no')->nullable();
            $table->string('title')->nullable();
            $table->string('guest_name');
            $table->string('print_name');
            $table->string('gender');
            $table->string('father_name')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('mobile');
            $table->string('nationality');
            $table->string('email')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('doc_type');
            $table->string('id_no');
            $table->integer('file_no');
            $table->string('checkin_date');
            $table->string('checkin_time');
            $table->string('exp_checkin_date');
            $table->string('exp_checkin_time');
            $table->string('tarif');
            $table->integer('non_taxable')->nullable();
            $table->string('company_name')->nullable();
            $table->string('default_grace_time')->nullable();
            $table->string('find_us')->nullable();
            $table->integer('own_vehicle')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('thru_agent')->nullable();
            $table->string('comming_form')->nullable();
            $table->string('comming_to')->nullable();
            $table->string('purpose_of_visit');
            $table->string('number_of_person');
            $table->string('relationship');
            $table->integer('male_no')->nullable();
            $table->integer('female_no')->nullable();
            $table->integer('children_no')->nullable();
            $table->string('id_proof_imag');
            $table->string('client_img');
            $table->text('additional_room')->nullable();
            $table->string('is_occupy')->nullable();

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
        Schema::dropIfExists('checkins');
    }
}
