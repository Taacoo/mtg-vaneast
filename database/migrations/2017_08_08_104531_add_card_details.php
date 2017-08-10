<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cards')) {

            Schema::table('cards', function (Blueprint $table) {

                $table->string('power', 10)->nullable();
                $table->string('toughness', 10)->nullable();
                $table->string('text', 255)->nullable();
                $table->string('cost', 255)->nullable();
                $table->integer('cmc', false)->length(10)->nullable()->unsigned();

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
