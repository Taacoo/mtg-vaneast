<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardDetailsAndDailyPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('daily_prices')) {
            Schema::create('daily_prices', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('card_id', false)->length(10)->nullable();
                $table->decimal('daily_sell', 8, 2)->nullable();
                $table->decimal('daily_low', 8, 2)->nullable();
                $table->decimal('daily_lowex', 8, 2)->nullable();
                $table->decimal('daily_lowfoil', 8, 2)->nullable();
                $table->decimal('daily_avg', 8, 2)->nullable();
                $table->decimal('daily_trend', 8, 2)->nullable();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('cardDetails')) {
            Schema::create('cardDetails', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255)->nullable();
                $table->string('manaCost', 50)->nullable();
                $table->string('cmc', 10)->nullable();
                $table->text('text')->nullable();
                $table->string('type', 255)->nullable();
                $table->string('power', 10)->nullable();
                $table->string('toughness', 10)->nullable();
                $table->timestamps();
            });
        }

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['daily_avg', 'daily_trend', 'daily_lowfoil', 'daily_lowex', 'daily_low', 'daily_sell']);
        });
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
