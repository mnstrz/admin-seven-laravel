<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminSevenCrud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_seven_crud', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('crud_name')->nullable();
            $table->string('crud_slug')->nullable();
            $table->longText('model')->nullable();
            $table->longText('attributes')->nullable();
            $table->integer('updated_id')->nullable();
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
        Schema::dropIfExists('admin_seven_crud');
    }
}
