<?php

namespace App\Listeners;

use App\Events\SubscribeSaving;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeSavingListener
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
     * @param  SubscribeSaving  $event
     * @return void
     */
    public function handle(SubscribeSaving $event)
    {
        $apply = $event->apply;
        $apply->hospital_ids = $apply->hospitalSearchString();
    }
}
