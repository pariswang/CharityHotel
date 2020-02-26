<?php

namespace App\Console\Commands;

use App\Model\Hotel;
use Illuminate\Console\Command;

class rebuildHotelIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重塑酒店搜索用的索引';

    /**
     * Create a new command instance.
     *
     * @return void
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
        Hotel::chunk(100, function ($hotels){
            $hotels->each(function ($hotel){
                $hotel->search_keywords = $hotel->keywords();
                $hotel->hospital_ids = $hotel->hospitalSearchString();
                $hotel->save();
            });
        });
    }
}
