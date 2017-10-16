<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['artist', 'text', 'flavor', 'mana_cost', 'cmc', 'modern', 'commander', 'classic', 'legacy', 'vintage']);
        });

        Schema::table('intrades', function (Blueprint $table) {
            $table->integer('locked_in', false)->length(1)->after('price_trend');
        });

        Schema::dropIfExists('supertypes');
        Schema::dropIfExists('types');
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
