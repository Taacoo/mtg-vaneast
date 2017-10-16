<?php

namespace App\Console\Commands;

use App\Expansion;
use App\MCM;
use Carbon\Carbon;
use Illuminate\Console\Command;

class getExpansions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mcm:getExpansions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get All the MTG Expansions';

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
        $url = 'https://www.mkmapi.eu/ws/v2.0/output.json/games/1/expansions';
        $return = MCM::request($url);


        foreach($return->expansion as $e){
            $exp = Expansion::firstorNew(array('mcm_expansion_id' => $e->idExpansion));

            $exp->name = $e->enName;
            $exp->mcm_abbr = $e->abbreviation;
            $exp->icon_abbr = $e->abbreviation;
            $exp->mcm_expansion_id = $e->idExpansion;
            $exp->release_date = Carbon::parse($e->releaseDate);

            $exp->save();
            $this->info($e->enName . ' Opgeslagen');
        }
    }
}
