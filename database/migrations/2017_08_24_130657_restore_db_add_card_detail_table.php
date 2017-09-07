<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestoreDbAddCardDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('formats')) {
            Schema::drop('formats');
        }

//        Schema::table('cards', function (Blueprint $table) {
//            $table->dropColumn(['artist', 'text', 'flavor', 'mana_cost', 'cmc', 'modern', 'commander', 'classic', 'legacy', 'vintage']);
//        });

//        Schema::create('card_details', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name', 255)->nullable();
//            $table->string('manaCost', 255)->nullable();
//            $table->string('cmc', 255)->nullable();
//            $table->string('type', 255)->nullable();
//            $table->string('text', 255)->nullable();
//            $table->string('power', 255)->nullable();
//            $table->string('toughness', 255)->nullable();
//
//            $table->timestamps();
//        });
        Schema::table('cards', function (Blueprint $table) {
            $table->decimal('daily_sell', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_low', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_lowex', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_lowfoil', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_trend', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_avg', 8, 2)->nullable()->after('mcm_meta_id');
        });

        Schema::drop('daily_prices');
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
