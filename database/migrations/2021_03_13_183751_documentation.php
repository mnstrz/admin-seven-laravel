<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Documentation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('documentation');
        Schema::create('documentation', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('parent')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('next')->nullable();
            $table->integer('prev')->nullable();
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
        Schema::dropIfExists('documentation');
    }
}
