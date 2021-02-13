<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Theme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('navbar_skin')->nullable();
            $table->string('sidebar_skin')->nullable();
            $table->string('brand_skin')->nullable();
            $table->string('accent_skin')->nullable();
            $table->string('card_skin')->nullable();
            $table->tinyInteger('is_no_navbar_border')->nullable();
            $table->tinyInteger('is_body_small')->nullable();
            $table->tinyInteger('is_navbar_small')->nullable();
            $table->tinyInteger('is_sidebar_small')->nullable();
            $table->tinyInteger('is_footer_small')->nullable();
            $table->tinyInteger('is_sidebar_flat')->nullable();
            $table->tinyInteger('is_sidebar_legacy')->nullable();
            $table->tinyInteger('is_sidebar_compact')->nullable();
            $table->tinyInteger('is_sidebar_child_indent')->nullable();
            $table->tinyInteger('is_sidebar_child_hide')->nullable();
            $table->tinyInteger('is_sidebar_disable_expand')->nullable();
            $table->tinyInteger('is_brand_small')->nullable();
            $table->tinyInteger('is_fixed_navbar')->nullable();
            $table->tinyInteger('is_fixed_footer')->nullable();
            $table->tinyInteger('is_sidebar_default_collapse')->nullable();
            $table->tinyInteger('is_boxed')->nullable();
            $table->tinyInteger('is_fixed_sidebar')->nullable();
            $table->tinyInteger('is_top_nav')->nullable();
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
        Schema::dropIfExists('theme');
    }
}
