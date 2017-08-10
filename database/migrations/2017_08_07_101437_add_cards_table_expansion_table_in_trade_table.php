<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardsTableExpansionTableInTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('expansions')) {

            Schema::create('expansions', function (Blueprint $table) {
                $table->increments('id')->signed();
                $table->string('name', 150)->default('expansion')->nullable();
                $table->string('abbreviation', 20)->default('exp')->nullable();
                $table->integer('icon', false)->length(6)->nullable()->unsigned();
                $table->integer('mcm_expansion_id', false)->length(6)->nullable();
                $table->string('release_date', 30)->default('1900-01-01');
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('cards')) {

            Schema::create('cards', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('mcm_product_id', false)->length(10)->nullable();
                $table->integer('mcm_meta_id', false)->length(10)->nullable();
                $table->string('name', 150)->nullable();
                $table->string('img_path', 255)->nullable();
                $table->string('rarity', 50)->nullable();
                $table->string('expansion_id', 10)->nullable()->unsigned();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('in_trade')) {

            Schema::create('in_trade', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('trade_id', false)->length(10)->nullable();
                $table->integer('card_id', false)->length(10)->nullable();
                $table->decimal('price_sell', 8, 2)->nullable();
                $table->decimal('price_low', 8, 2)->nullable();
                $table->decimal('price_lowfoil', 8, 2)->nullable();
                $table->decimal('price_avg', 8, 2)->nullable();
                $table->decimal('price_trend', 8, 2)->nullable();
                $table->integer('locked_in', false)->length(1)->default('0');
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
        //
    }
}
