<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationBarTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_bar_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->json('items');
            $table->integer('related_article_amount');
            $table->timestamps();
        });
        Schema::create('navigation_bar', function (Blueprint $table) {
            $table->increments('id');
            $table->json('bar');
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
        Schema::drop('navigation_bar_setting');
        Schema::drop('navigation_bar');
    }
}
