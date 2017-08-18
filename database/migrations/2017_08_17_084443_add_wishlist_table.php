<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('wishlists')) {

            Schema::create('wishlists', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->default('Wishlist')->nullable();
                $table->integer('user_id', false)->length(10);
                $table->timestamps();
            });

            Schema::create('user_wishlist', function (Blueprint $table) {
                $table->integer('user_id');
                $table->integer('wishlist_id');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('wishlist_id')
                    ->references('id')
                    ->on('wishlists');

                $table->primary(array('user_id', 'wishlist_id'));
            });
        }

        if(!Schema::hasTable('inwishlists')) {

            Schema::create('inwishlists', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wishlist_id', false)->length(10)->nullable();
                $table->integer('card_id', false)->length(10)->nullable();
                $table->integer('quantity', false)->length(10)->nullable();
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
