<?php

namespace App\Console\Commands;

use App\Model\Subscribe;
use Illuminate\Console\Command;

class ApplyAutoExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:expired';

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
        $list = Subscribe::where('status', '<', 5)
            ->where('hide_status', 0)
            ->where('date_begin', '<', date('Y-m-d'))
            ->get();
        $list->each(function ($apply){
            $apply->hide_status = 1;
            $apply->save();
            \Log::info("[apply]" . $apply->id . ' Expired!');
        });
    }
}
