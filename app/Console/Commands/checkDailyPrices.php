<?php

namespace App\Console\Commands;

use App\Card;
use Illuminate\Console\Command;

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
        $cards = Card::where('daily_avg', '!=', null)->get();

        foreach($cards as $c){
            if(date('d-m-Y', strtotime($c->updated_at)) != date('d-m-Y')){
                $c->daily_sell = null;
                $c->daily_low = null;
                $c->daily_lowex = null;
                $c->daily_lowfoil = null;
                $c->daily_avg = null;
                $c->daily_trend = null;
                $c->save();

                continue;
            }
            continue;
        }
    }
}
