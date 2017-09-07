<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTablesAddRulingFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('subtypes', 'types', 'supertypes');

        if(!Schema::hasTable('rulings')) {

            Schema::create('rulings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('card_detail_id', false)->length(10)->nullable();
                $table->text('text')->nullable();
                $table->string('date', 50)->default('')->nullable();

                $table->timestamps();
            });
        }

        if(!Schema::hasTable('legalities')) {

            Schema::create('legalities', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('card_detail_id', false)->length(10)->nullable();
                $table->string('format', 50)->default('format')->nullable();
                $table->string('legality', 50)->default('legality')->nullable();

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
