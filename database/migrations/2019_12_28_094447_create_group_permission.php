<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('group_permission');
        Schema::create('group_permission', function (Blueprint $table) {
            $table->increments('id',11);
            $table->unsignedInteger('group')->nullable();
            $table->unsignedInteger('permission')->nullable();
            $table->timestamps();
            $table->foreign('group', 'group_ibfk_2')->references('id')->on('group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('permission', 'permission_ibfk_1')->references('id')->on('permission')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_permission');
    }
}
