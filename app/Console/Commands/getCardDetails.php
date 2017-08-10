<?php

namespace App\Console\Commands;

use App\Card;
use Illuminate\Console\Command;

class getCardDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:getCardDetails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $cards = Card::select('*')->groupBy('name')->get();

        foreach($cards as $c){

        }
    }
}
