<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Configuration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('configuration');
        Schema::create('configuration', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('app_name')->nullable();
            $table->string('website_domain')->nullable();
            $table->string('smtp_mail_server')->nullable();
            $table->string('smtp_mail_port')->nullable();
            $table->string('smtp_mail_username')->nullable();
            $table->string('smtp_mail_password')->nullable();
            $table->string('smtp_mail_name')->nullable();
            $table->string('smtp_mail_address')->nullable();
            $table->longText('logo')->nullable();
            $table->longText('favicon')->nullable();
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
        Schema::dropIfExists('configuration');
    }
}
