<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeSubtypesSupertypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('types')) {

            Schema::create('types', function (Blueprint $table) {
                $table->increments('id')->signed();
                $table->string('name', 150)->default('expansion')->nullable();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('subtypes')) {

            Schema::create('subtypes', function (Blueprint $table) {
                $table->increments('id')->signed();
                $table->string('name', 150)->default('expansion')->nullable();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('supertypes')) {

            Schema::create('supertypes', function (Blueprint $table) {
                $table->increments('id')->signed();
                $table->string('name', 150)->default('expansion')->nullable();
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
