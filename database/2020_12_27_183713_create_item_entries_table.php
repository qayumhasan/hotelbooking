<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_entries', function (Blueprint $table) {
            $table->id();
            $table->text('item_name')->nullable();
            $table->string('short_name',50)->nullable();
            $table->foreignId('category_name')->nullable();
            $table->foreignId('unit_name')->nullable();
            $table->float('rate')->nullable();
            $table->integer('min_level')->nullable();
            $table->string('menu_item',50)->nullable();
            $table->string('date',50)->nullable();
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
        Schema::dropIfExists('item_entries');
    }
}
