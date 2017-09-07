<?php

namespace App\Console\Commands;

use App\Card;
use App\Expansion;
use App\MCM;
use Illuminate\Console\Command;

class getCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mcm:getCards';

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
        $expansions = Expansion::where('id', '>', 310)->get();

        foreach($expansions as $expansion){
            $cards = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/expansions/'. $expansion->mcm_expansion_id .'/singles');

            foreach ($cards->single as $c){
                $card = Card::firstorNew(array('mcm_product_id' => $c->idProduct));

                $card->name = $c->enName;
                $card->mcm_product_id = $c->idProduct;
                $card->mcm_meta_id = $c->idMetaproduct;
                $card->img_path = $c->image;
                $card->rarity = $c->rarity;
                $card->expansion_id = $expansion->id;

                $card->save();

                $this->info($card->name . ' Opgeslagen');
            }
        }

    }
}
