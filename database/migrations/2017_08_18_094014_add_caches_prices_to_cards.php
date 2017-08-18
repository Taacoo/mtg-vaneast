<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCachesPricesToCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->decimal('daily_sell', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_low', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_lowex', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_lowfoil', 8, 2)->nullable()->after('mcm_meta_id');
            $table->decimal('daily_trend', 8, 2)->nullable()->after('mcm_meta_id');
            $table->renameColumn('daily_price', 'daily_avg');
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
