<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('expansions')) {
            Schema::create('formats', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('card_id', false)->length(10)->nullable()->unsigned();
                $table->string('format', 50)->default('')->nullable();
                $table->string('legality', 50)->default('')->nullable();

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
