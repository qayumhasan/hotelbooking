<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('userid')->nullable();
            $table->integer('user_role')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('employee_id')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('refer_by')->nullable();
            $table->integer('status')->default(1);
            $table->string('entry_by')->nullable();
            $table->string('entry_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('updated_date')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->integer('branch_id')->nullable();
            $table->string('branch_name')->nullable();
            $table->integer('is_approve')->default(0);
            $table->string('approve_by')->nullable();
            $table->string('approve_date')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
