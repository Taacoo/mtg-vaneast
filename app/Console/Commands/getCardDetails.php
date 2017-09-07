<?php

namespace App\Console\Commands;

use App\cardDetail;
use App\Legality;
use App\MCM;
use App\Ruling;
use Illuminate\Console\Command;
use App\Card;
use Illuminate\Support\Facades\File;


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
    protected $description = ' ';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     *
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        $path = storage_path() . "/json/AllCards-x.json";
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }

        $file = json_decode(File::get($path));

        foreach($file as $c){

            $card = cardDetail::updateOrCreate(array('name' => $c->name));

            $card->name = $c->name;
            if(array_key_exists('manaCost', $c)) {
                $card->manaCost = $c->manaCost;
            }
            if(array_key_exists('cmc', $c)) {
                $card->cmc = $c->cmc;
            }
            if(array_key_exists('power', $c)) {
                $card->power = $c->power;
            }
            if(array_key_exists('toughness', $c)) {
                $card->toughness = $c->toughness;
            }
            if(array_key_exists('text', $c)) {
                $card->text = $c->text;
            }

            if(array_key_exists('type', $c)) {
                $card->type = $c->type;
            }
            $card->save();

            if(array_key_exists('legalities', $c)) {
                foreach($c->legalities as $l){
                    if($l->format == 'Modern' || $l->format == 'Modern' || $l->format == 'Commander' || $l->format == 'Legacy' || $l->format == 'Standard' ||  $l->format == 'Vintage'){
                        $format = Legality::updateOrCreate(array('format' => $l->format ));

                        $format->card_detail_id = $card->id;
                        $format->format = $l->format;
                        $format->legality = $l->legality;
                        $format->save();
                    }
                }
            }

            if(array_key_exists('rulings', $c)) {
                foreach($c->rulings as $r){
                    $ruling = Ruling::firstorNew(array('card_detail_id' => $card->id, 'date' => $r->date));

                    $ruling->card_detail_id = $card->id;
                    $ruling->text = base64_encode($r->text);
                    $ruling->date = $r->date;
                    $ruling->save();
                }
            }
        }

    }
}
