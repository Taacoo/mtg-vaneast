<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('trades')) {

            Schema::create('trades', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->default('Ruillijst')->nullable();
                $table->timestamps();
            });

            Schema::create('trade_user', function (Blueprint $table) {
                $table->integer('user_id');
                $table->integer('trade_id');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('trade_id')
                    ->references('id')
                    ->on('trades');

                $table->primary(array('user_id', 'trade_id'));
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
        //
    }
}
