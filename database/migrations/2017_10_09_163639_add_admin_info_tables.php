<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminInfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('daily_price_requests')) {
            Schema::create('daily_price_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('amount')->lenth(10)->unsigned()->nullable();
                $table->decimal('value', 8,2)->default(0.00);
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_price_requests');
    }
}
