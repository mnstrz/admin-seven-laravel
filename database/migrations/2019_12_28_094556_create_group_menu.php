<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('group_menu');
        Schema::create('group_menu', function (Blueprint $table) {
            $table->increments('id',11);
            $table->unsignedInteger('group')->nullable();
            $table->unsignedInteger('menu')->nullable();
            $table->timestamps();
            $table->foreign('group', 'group_ibfk_3')->references('id')->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('menu', 'menu_ibfk_1')->references('id')->on('menu')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_menu');
    }
}
