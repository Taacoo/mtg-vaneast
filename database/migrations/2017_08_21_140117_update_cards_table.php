<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->string('vintage', 50)->after('cmc')->nullable();
            $table->string('legacy', 50)->after('cmc')->nullable();
            $table->string('classic', 50)->after('cmc')->nullable();
            $table->string('commander', 50)->after('cmc')->nullable();
            $table->string('modern', 50)->after('cmc')->nullable();

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
