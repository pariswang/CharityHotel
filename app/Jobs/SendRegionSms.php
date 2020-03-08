<?php

namespace App\Jobs;

use App\Model\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendRegionSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apply;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscribe $sub)
    {
        $this->apply = $sub;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(strpos($this->apply->date_begin, '-') > 0){
            $date = explode('-', $this->apply->date_begin);
        }elseif(strpos($this->apply->date_begin, '/') > 0){
            $date = explode('/', $this->apply->date_begin);
        }else{
            return;
        }
        $date = $date[1] . '月' . $date[2] . '日';

        foreach($this->apply->region->hotels as $hotel){
            $phone = str_replace(' ', '', $hotel->phone);
            $r = sendSms(
                $phone,
                config('sms.sms_config.request_area_code'),
                json_encode([
                    'name'=>$this->apply->conn_person,
                    'date'=>$date,
                    'area' => $this->apply->region->region_name]));

            \Log::info("[sms][request_area_code] $phone: " . $r);
        }
    }
}
