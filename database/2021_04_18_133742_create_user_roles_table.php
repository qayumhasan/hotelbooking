<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->integer('admin')->default(0);
            $table->integer('front_office')->default(0);
            $table->integer('food_beverage')->default(0);
            $table->integer('house-kipping')->default(0);
            $table->integer('restuarent')->default(0);
            $table->integer('payroll')->default(0);
            $table->integer('banquet')->default(0);
            $table->integer('accounts')->default(0);
            $table->integer('inventory')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('is_adminestator')->default(0);
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
        Schema::dropIfExists('user_roles');
    }
}
