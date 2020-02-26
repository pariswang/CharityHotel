<?php

namespace App\Listeners;

use App\Events\HotelSaving;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HotelSavingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  HotelSaving  $event
     * @return void
     */
    public function handle(HotelSaving $event)
    {
        $hotel = $event->hotel;
        $hotel->search_keywords = $hotel->keywords();
        $hotel->hospital_ids = $hotel->hospitalSearchString();
    }
}
