<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDatabaseForCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expansions', function (Blueprint $table) {
            $table->string('icon_abbr', 250)->nullable()->after('abbreviation');
        });

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

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['daily_sell', 'daily_low', 'daily_lowex', 'daily_lowfoil', 'daily_avg', 'daily_trend']);
            $table->string('artist', 255)->after('rarity')->nullable();
            $table->text('text', 255)->after('artist')->nullable();
            $table->text('flavor', 255)->after('text')->nullable();
            $table->string('mana_cost', 255)->after('flavor')->nullable();
            $table->integer('cmc', false)->after('mana_cost')->length(6)->nullable();
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
