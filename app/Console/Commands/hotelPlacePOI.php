<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Hotel;
use App\Services\BMap\PlaceAPI;

class hotelPlacePOI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $api = new PlaceAPI();

        Hotel::where('lat', null)->get()->each(function ($hotel) use($api) {
            $hotelStr = $hotel->hotel_name . ' ' . $hotel->address;
            $this->info($hotelStr);
            $results = $api->region($hotel->hotel_name);
            if(!isset($results[0])){
                $this->error("没有找到！");
                return;
            }

            foreach($results as $index => $result){
                $this->info("\t[" . $index . '] ' . $result['name'] . ':' . $result['address']);
            }

            $index = $this->ask("请选择正确的地址序号？");
            if($index === null){
                return;
            }

            $this->info("导入...");
            $hotel->lat = $results[$index]['location']['lat'];
            $hotel->lng = $results[$index]['location']['lng'];
            $hotel->save();
        });
    }
}
