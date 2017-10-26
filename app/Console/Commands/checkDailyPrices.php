<?php

namespace App\Console\Commands;

use App\Card;
use App\dailyPrice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class checkDailyPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mcm:checkDailyPrices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all Daily prices';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $checked = dailyPrice::all();
        if(count($checked) != 0){
            $price = 0;
            foreach($checked as $c){
                $price = $price + $c->daily_avg;
            }

            DB::table('daily_pric_requests')->insert([
                'amount' => count($checked),
                'value' => $price,
            ]);
        }

        dailyPrice::truncate();
    }
}
